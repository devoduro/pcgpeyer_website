/** @type {import('tailwindcss').Config} */

/* PCG crest blue: primary actions, links, active nav. */
const brand = {
  50: '#eef3fc', 100: '#dce5f8', 200: '#b9caf0', 300: '#8ea8e4', 400: '#5f80d4',
  500: '#2f56b8', 600: '#1f4396', 700: '#1b3778', 800: '#182e60', 900: '#14254d', 950: '#0b1630',
};

/* PCG crest red: the "Plan Your Visit" call to action, highlights, badges. */
const accent = {
  50: '#fef2f2', 100: '#fee2e2', 200: '#fecaca', 300: '#fca5a5', 400: '#f26b6b',
  500: '#e03a3a', 600: '#c8232a', 700: '#a71d23', 800: '#8a1b20', 900: '#731b1f', 950: '#3f0a0c',
};

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/views/dashboard/**/*.blade.php",
  ],
  theme: {
    extend: {
      colors: {
        brand,
        accent,
        /* Navy: dark hero, footer and section backgrounds sitting over photography. */
        navy: {
          50: '#eef1fb', 100: '#dde3f7', 200: '#b9c4ef', 300: '#8fa0e3', 400: '#5b74d1',
          500: '#3a51b0', 600: '#28409e', 700: '#1d2a6b', 800: '#16204f', 900: '#10163f', 950: '#080b22',
        },
        /* Ink: neutral text and surfaces. */
        ink: {
          50: '#f8f9fa', 100: '#f1f3f5', 200: '#e5e8eb', 300: '#ced4da', 400: '#9aa3ab',
          500: '#6c757d', 600: '#4f575e', 700: '#3b4248', 800: '#2c2c2c', 900: '#1d2124', 950: '#121416',
        },
        /* Older pages use the pcg-* names; they now resolve to the same palette. */
        'pcg-blue': brand,
        'pcg-red': accent,
        'pcg-gold': {
          50: '#fffbeb', 100: '#fef3c7', 200: '#fde68a', 300: '#fcd34d',
          400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309',
        },
        // Dashboard admin theme, ported from slce_portal
        primary: {
          50: '#f0f9ff', 100: '#e0f2fe', 200: '#bae6fd', 300: '#7dd3fc', 400: '#38bdf8',
          500: '#0ea5e9', 600: '#0284c7', 700: '#0369a1', 800: '#075985', 900: '#0c4a6e',
        },
      },
      fontFamily: {
        'sans': ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        'display': ['"Plus Jakarta Sans"', 'Inter', 'ui-sans-serif', 'sans-serif'],
        'serif': ['"Plus Jakarta Sans"', 'Inter', 'ui-sans-serif', 'sans-serif'],
        'poppins': ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      boxShadow: {
        card: '0 1px 2px rgba(28,28,28,.04), 0 4px 16px rgba(28,28,28,.06)',
        lift: '0 8px 28px rgba(28,28,28,.12)',
        brand: '0 8px 24px rgba(31,67,150,.28)',
        accent: '0 8px 24px rgba(200,35,42,.28)',
        glass: '0 8px 32px 0 rgba(30, 58, 138, 0.18)',
      },
      borderRadius: { '4xl': '1.75rem' },
      maxWidth: { site: '1180px' },
      backgroundImage: {
        /* The hero treatment: navy wash over photography. */
        'hero-wash': 'linear-gradient(160deg, rgba(16,22,63,.93) 0%, rgba(8,11,34,.96) 55%, rgba(29,42,107,.88) 100%)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
