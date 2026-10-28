/** @type {import('tailwindcss').Config} */

/* PCG crest blue: primary actions, links, active nav. */
const brand = {
  50: '#F1F4FA', 100: '#E4E9F5', 200: '#C9D2E8', 300: '#AAB8D6', 400: '#7183B1',
  500: '#172554', 600: '#172554', 700: '#111c3e', 800: '#0d1633', 900: '#0b1229', 950: '#070c1b',
};

/* PCG crest red: the "Plan Your Visit" call to action, highlights, badges. */
const accent = {
  50: '#FEF2F2', 100: '#FEE2E2', 200: '#FECACA', 300: '#FCA5A5', 400: '#F87171',
  500: '#DC2626', 600: '#DC2626', 700: '#B91C1C', 800: '#991B1B', 900: '#7F1D1D', 950: '#450A0A',
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
        heading: '#0F172A',
        muted: '#64748B',
        page: '#F8FAFC',
        surface: '#FFFFFF',
        line: '#E2E8F0',
        /* Keep older gray utility classes on the same slate neutral scale. */
        gray: {
          50: '#F8FAFC', 100: '#F1F5F9', 200: '#E2E8F0', 300: '#CBD5E1', 400: '#94A3B8',
          500: '#64748B', 600: '#475569', 700: '#334155', 800: '#1E293B', 900: '#0F172A', 950: '#020617',
        },
        /* Navy: dark hero, footer and section backgrounds sitting over photography. */
        navy: {
          50: '#F1F4FA', 100: '#E4E9F5', 200: '#C9D2E8', 300: '#AAB8D6', 400: '#7183B1',
          500: '#172554', 600: '#172554', 700: '#111c3e', 800: '#0d1633', 900: '#0b1229', 950: '#070c1b',
        },
        /* Ink: neutral text and surfaces. */
        ink: {
          50: '#F8FAFC', 100: '#F1F5F9', 200: '#E2E8F0', 300: '#CBD5E1', 400: '#94A3B8',
          500: '#64748B', 600: '#475569', 700: '#334155', 800: '#1E293B', 900: '#0F172A', 950: '#020617',
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
          50: '#F1F4FA', 100: '#E4E9F5', 200: '#C9D2E8', 300: '#AAB8D6', 400: '#7183B1',
          500: '#172554', 600: '#172554', 700: '#111c3e', 800: '#0d1633', 900: '#0b1229',
        },
      },
      fontFamily: {
        'sans': ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        'display': ['"Plus Jakarta Sans"', 'Inter', 'ui-sans-serif', 'sans-serif'],
        'serif': ['"Plus Jakarta Sans"', 'Inter', 'ui-sans-serif', 'sans-serif'],
        'poppins': ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      boxShadow: {
        card: '0 1px 2px rgba(15,23,42,.04), 0 8px 24px rgba(15,23,42,.06)',
        lift: '0 12px 32px rgba(15,23,42,.12)',
        brand: '0 8px 24px rgba(23,37,84,.20)',
        accent: '0 8px 24px rgba(220,38,38,.20)',
        glass: '0 8px 32px 0 rgba(30, 58, 138, 0.18)',
      },
      borderRadius: { '4xl': '1.75rem' },
      maxWidth: { site: '1180px' },
      backgroundImage: {
        /* The hero treatment: navy wash over photography. */
        'hero-wash': 'linear-gradient(160deg, rgba(23,37,84,.93) 0%, rgba(7,12,27,.96) 55%, rgba(17,28,62,.88) 100%)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
