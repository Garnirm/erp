<template>
    <div class="brand-panel">
    </div>

    <div class="form-panel">
        <div class="form-container">
            <div class="company-logo">G</div>

            <h1>Bon retour</h1>
            <p class="subtitle">Connectez-vous pour accéder à votre espace.</p>

            <form method="POST">
                <input type="hidden" name="_token" :value="csrf_token" />

                <div class="form-group">
                    <label class="form-label" for="email">Email professionnel</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="nom@entreprise.drk" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>

                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>

                        <button type="button" class="password-toggle" @click="togglePassword()">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-actions">
                    <label class="checkbox-label">
                        <input type="checkbox" class="checkbox-input">
                        Se souvenir de moi
                    </label>

                    <a href="#" class="link">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="btn-submit">Se connecter</button>
            </form>

            <div class="login-footer">
                Pas encore de compte ? <a href="#" class="link">Contacter l'admin</a>
            </div>
        </div>

        <div style="position: absolute; bottom: 1rem; font-size: 0.75rem; color: var(--color-slate-400);">
            © 2025 ERP. Tous droits réservés.
        </div>
    </div>
</template>

<script>
export default {
    inject: [ 'csrf_token' ],

    methods: {
        togglePassword: function () {
            const input = document.getElementById('password')
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password'

            input.setAttribute('type', type)
        },
    },
}
</script>

<style lang="scss">
body {
    display: flex;
    overflow: hidden;
}

#app {
    display: flex;
    width: 100%;
    height: 100%;
}

.brand-panel {
    flex: 1;
    display: none;
    position: relative;
    background-image: url('https://plus.unsplash.com/premium_photo-1720857673569-3b2d8c886096?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
    background-size: cover;
    background-position: center;
}

.brand-panel::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg, 
        var(--color-slate-900) 0%, 
        var(--color-primary-600) 100%
    );
    opacity: 0.85;
    mix-blend-mode: multiply;
}

.brand-content {
    position: relative;
    z-index: 10;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 4rem;
    color: white;
}

.brand-quote {
    font-size: 1.5rem;
    font-weight: 500;
    line-height: 1.4;
    max-width: 32rem;
    margin-bottom: 1.5rem;
}

.brand-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.brand-author-avatar {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.3);
}

.form-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem;
    background-color: white;
    position: relative;
}

.form-container {
    width: 100%;
    max-width: 24rem;
}

.company-logo {
    width: 3rem;
    height: 3rem;
    background-color: var(--color-primary-600);
    color: white;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
}

h1 {
    font-size: 1.875rem;
    font-weight: 700;
    color: var(--color-slate-900);
    letter-spacing: -0.025em;
    margin-bottom: 0.5rem;
}

.subtitle {
    color: var(--color-slate-500);
    margin-bottom: 2.5rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--color-slate-900);
    margin-bottom: 0.375rem;
}

.form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--color-slate-200);
    border-radius: var(--radius-lg);
    font-size: 0.875rem;
    color: var(--color-slate-900);
    transition: var(--transition-base);
    outline: none;
}

.form-input:focus {
    border-color: var(--color-primary-600);
    box-shadow: 0 0 0 3px color-mix(in srgb, var(--color-primary-600), transparent 85%);
}

.password-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 0; top: 0; bottom: 0;
    padding: 0 1rem;
    background: none; border: none;
    color: var(--color-slate-400);
    cursor: pointer;
    display: flex; align-items: center;
}

.password-toggle:hover {
    color: var(--color-slate-600);
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.checkbox-label {
    display: flex; align-items: center; gap: 0.5rem;
    font-size: 0.875rem; color: var(--color-slate-600); cursor: pointer;
}

.checkbox-input {
    width: 1rem; height: 1rem;
    accent-color: var(--color-primary-600);
    cursor: pointer;
}

.link {
    font-size: 0.875rem; font-weight: 500;
    color: var(--color-primary-600);
    text-decoration: none;
}

.link:hover {
    text-decoration: underline;
}

.btn-submit {
    width: 100%;
    padding: 0.75rem;
    background-color: var(--color-primary-600);
    color: white;
    border: none;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: var(--transition-base);
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
}

.btn-submit:hover {
    filter: brightness(110%);
    transform: translateY(-1px);
}

.btn-submit:active {
    transform: translateY(0);
}

.login-footer {
    margin-top: 2rem;
    text-align: center;
    font-size: 0.875rem;
    color: var(--color-slate-500);
}

@media (min-width: 1024px) {
    .brand-panel {
        display: block;
        flex: 1.2;
    }

    .form-panel {
        flex: 1;
    }
}

.demo-controls {
    position: fixed; bottom: 1.5rem; right: 1.5rem;
    background: white; padding: 1rem;
    border-radius: var(--radius-lg);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
    border: 1px solid var(--color-slate-200);
    z-index: 100; width: 200px;
}

.demo-title {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--color-slate-400);
    margin-bottom: 0.5rem;
}

.demo-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.color-picker {
    width: 2rem;
    height: 2rem;
    border: none;
    cursor: pointer;
    padding: 0;
    background: none;
}
</style>