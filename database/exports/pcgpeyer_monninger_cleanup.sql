-- Targeted cleanup for old Rev. Friedrich Monninger Congregation records.
-- Safe to import into an existing Peyer database: this does not replace tables
-- or modify unrelated dashboard content.

START TRANSACTION;

UPDATE leadership
SET active = 0,
    is_current = 0,
    updated_at = CURRENT_TIMESTAMP
WHERE name IN (
    'Rev. George Agyei Kwabi',
    'Rev. Emmanuel Kwame Adofo',
    'Eric Siako',
    'Ernest Gyan Asare',
    'Cat. Emmanuel Ansah Brefo',
    'Cat. Daniel Aboagye',
    'Moses Teye Tetteh',
    'Mrs. Esther Ofosua Asante',
    'Mrs. Emma Kay Holm',
    'Mr. Ernest Gyan Asare',
    'Mr. Eric Siako',
    'Mr. Seth Obeng Adu',
    'Mr. Martin Agbenyegah',
    'Mad. Christiana Darkoa',
    'Mr. Samuel Yirenkyi Addo',
    'Mrs. Margaret Debrah',
    'Ms. Yvette N.A. Amankwa - Youth Rep.',
    'Mr. Sebastian Richard Danful',
    'Mr. Samora Owusu Agyei',
    'Mr. William Avorkliyah',
    'Mr. Eric Nyarko',
    'Mr. Samuel Danso Kumi',
    'Mrs. Elizabeth Bruce',
    'Mad. Christiana Boahene',
    'Mr. Moses T. Tetteh',
    'Mr. Samuel Anim Tieku',
    'Mrs. Victoria Agbohla',
    'Ms. Elizabeth Quaye',
    'Mr. Kelvin Kweku Donkor'
);

UPDATE ministries
SET leader = NULL,
    leader_phone = NULL,
    leader_picture = NULL,
    updated_at = CURRENT_TIMESTAMP
WHERE leader IN (
    'Sis. Elizabeth M.D. Bruce',
    'Ebenezer Akuffo',
    'Bro. MARTIN AGBENYEGAH',
    'Children''s Ministry Director',
    'J.Y Teachers',
    'Yvette Donkor',
    'Elizabeth Quaye',
    'Sister Florence Asamoah',
    'Men''s Ministry Leader'
);

DELETE FROM blog_posts
WHERE slug IN (
    '90-score-for-covid-19-protocol-adherence',
    'ecumenical-visit-to-akosombo-muslim-community',
    'unlocking-ewe-culture-through-food',
    'yaf-donates-stationery-to-vra-presby-school'
);

DELETE gi
FROM gallery_images AS gi
JOIN galleries AS g ON g.id = gi.gallery_id
WHERE g.title IN (
    '2025 Traditional Sunday',
    '2025 Men''s Week Thankgiving Service',
    'Service In Honour of Hon. Thomas Ampem Nyarko'
);

DELETE FROM galleries
WHERE title IN (
    '2025 Traditional Sunday',
    '2025 Men''s Week Thankgiving Service',
    'Service In Honour of Hon. Thomas Ampem Nyarko'
);

COMMIT;
