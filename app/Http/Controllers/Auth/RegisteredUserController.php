<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Error;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                /*'password' => Hash::make($request->password),*/
                'password' => $request->password,
            ]);

            event(new Registered($user));

            $this->createPostgresUserWithRole($user->name, $user->password,"pg_read_all_data");


            DB::commit();

            Auth::login($user);
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->withErrors(['registration' => 'Failed to create PostgreSQL user. Ensure the name is unique and contains no spaces.']);
        } catch (Error $e) {
            DB::rollBack();
            return back()->withErrors(['registration' => 'An unexpected error occurred.']);
        }
        return redirect(route('dashboard', absolute: false));
    }
    private function createPostgresUserWithRole($username, $password,$role="pg_read_all_data")
    {

        $existingUser = DB::connection('pgsql')->select("SELECT * FROM pg_catalog.pg_user WHERE usename = ?", [$username]);
        if (!empty($existingUser)) {
            throw new \Exception("User {$username} already exists.");
        }
        DB::connection('pgsql')->statement("CREATE USER {$username} WITH PASSWORD '{$password}';");

        DB::connection('pgsql')->statement("GRANT {$role} TO {$username};");
    }


}
