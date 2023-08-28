<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    // public $countries = [
    //     [
    //         'name' => 'Malaysia",
    //         'updated_at' => null,
    //         'created_by' => 1
    //     ],
    //     [
    //         'name' => 'Singapore",
    //         'updated_at' => null,
    //         'created_by' => 1
    //     ],
    // ];

    public function run()
    {
        $sql = <<<SQL
        INSERT INTO `countries` (`id`, `code`, `name`, `phone`) VALUES
        (1, "AF", "Afghanistan", 93),
        (2, "AX", "Aland Islands", 358),
        (3, "AL", "Albania", 355),
        (4, "DZ", "Algeria", 213),
        (5, "AS", "American Samoa", 1684),
        (6, "AD", "Andorra", 376),
        (7, "AO", "Angola", 244),
        (8, "AI", "Anguilla", 1264),
        (9, "AQ", "Antarctica", 672),
        (10, "AG", "Antigua and Barbuda", 1268),
        (11, "AR", "Argentina", 54),
        (12, "AM", "Armenia", 374),
        (13, "AW", "Aruba", 297),
        (14, "AU", "Australia", 61),
        (15, "AT", "Austria", 43),
        (16, "AZ", "Azerbaijan", 994),
        (17, "BS", "Bahamas", 1242),
        (18, "BH", "Bahrain", 973),
        (19, "BD", "Bangladesh", 880),
        (20, "BB", "Barbados", 1246),
        (21, "BY", "Belarus", 375),
        (22, "BE", "Belgium", 32),
        (23, "BZ", "Belize", 501),
        (24, "BJ", "Benin", 229),
        (25, "BM", "Bermuda", 1441),
        (26, "BT", "Bhutan", 975),
        (27, "BO", "Bolivia", 591),
        (28, "BQ", "Bonaire, Sint Eustatius and Saba", 599),
        (29, "BA", "Bosnia and Herzegovina", 387),
        (30, "BW", "Botswana", 267),
        (31, "BV", "Bouvet Island", 55),
        (32, "BR", "Brazil", 55),
        (33, "IO", "British Indian Ocean Territory", 246),
        (34, "BN", "Brunei Darussalam", 673),
        (35, "BG", "Bulgaria", 359),
        (36, "BF", "Burkina Faso", 226),
        (37, "BI", "Burundi", 257),
        (38, "KH", "Cambodia", 855),
        (39, "CM", "Cameroon", 237),
        (40, "CA", "Canada", 1),
        (41, "CV", "Cape Verde", 238),
        (42, "KY", "Cayman Islands", 1345),
        (43, "CF", "Central African Republic", 236),
        (44, "TD", "Chad", 235),
        (45, "CL", "Chile", 56),
        (46, "CN", "China", 86),
        (47, "CX", "Christmas Island", 61),
        (48, "CC", "Cocos (Keeling) Islands", 672),
        (49, "CO", "Colombia", 57),
        (50, "KM", "Comoros", 269),
        (51, "CG", "Congo", 242),
        (52, "CD", "Congo, Democratic Republic of the Congo", 242),
        (53, "CK", "Cook Islands", 682),
        (54, "CR", "Costa Rica", 506),
        (55, "CI", "Cote D\'Ivoire", 225),
        (56, "HR", "Croatia", 385),
        (57, "CU", "Cuba", 53),
        (58, "CW", "Curacao", 599),
        (59, "CY", "Cyprus", 357),
        (60, "CZ", "Czech Republic", 420),
        (61, "DK", "Denmark", 45),
        (62, "DJ", "Djibouti", 253),
        (63, "DM", "Dominica", 1767),
        (64, "DO", "Dominican Republic", 1809),
        (65, "EC", "Ecuador", 593),
        (66, "EG", "Egypt", 20),
        (67, "SV", "El Salvador", 503),
        (68, "GQ", "Equatorial Guinea", 240),
        (69, "ER", "Eritrea", 291),
        (70, "EE", "Estonia", 372),
        (71, "ET", "Ethiopia", 251),
        (72, "FK", "Falkland Islands (Malvinas)", 500),
        (73, "FO", "Faroe Islands", 298),
        (74, "FJ", "Fiji", 679),
        (75, "FI", "Finland", 358),
        (76, "FR", "France", 33),
        (77, "GF", "French Guiana", 594),
        (78, "PF", "French Polynesia", 689),
        (79, "TF", "French Southern Territories", 262),
        (80, "GA", "Gabon", 241),
        (81, "GM", "Gambia", 220),
        (82, "GE", "Georgia", 995),
        (83, "DE", "Germany", 49),
        (84, "GH", "Ghana", 233),
        (85, "GI", "Gibraltar", 350),
        (86, "GR", "Greece", 30),
        (87, "GL", "Greenland", 299),
        (88, "GD", "Grenada", 1473),
        (89, "GP", "Guadeloupe", 590),
        (90, "GU", "Guam", 1671),
        (91, "GT", "Guatemala", 502),
        (92, "GG", "Guernsey", 44),
        (93, "GN", "Guinea", 224),
        (94, "GW", "Guinea-Bissau", 245),
        (95, "GY", "Guyana", 592),
        (96, "HT", "Haiti", 509),
        (97, "HM", "Heard Island and Mcdonald Islands", 0),
        (98, "VA", "Holy See (Vatican City State)", 39),
        (99, "HN", "Honduras", 504),
        (100, "HK", "Hong Kong", 852),
        (101, "HU", "Hungary", 36),
        (102, "IS", "Iceland", 354),
        (103, "IN", "India", 91),
        (104, "ID", "Indonesia", 62),
        (105, "IR", "Iran, Islamic Republic of", 98),
        (106, "IQ", "Iraq", 964),
        (107, "IE", "Ireland", 353),
        (108, "IM", "Isle of Man", 44),
        (109, "IL", "Israel", 972),
        (110, "IT", "Italy", 39),
        (111, "JM", "Jamaica", 1876),
        (112, "JP", "Japan", 81),
        (113, "JE", "Jersey", 44),
        (114, "JO", "Jordan", 962),
        (115, "KZ", "Kazakhstan", 7),
        (116, "KE", "Kenya", 254),
        (117, "KI", "Kiribati", 686),
        (118, "KP", "Korea, Democratic People\'s Republic of", 850),
        (119, "KR", "Korea, Republic of", 82),
        (120, "XK", "Kosovo", 383),
        (121, "KW", "Kuwait", 965),
        (122, "KG", "Kyrgyzstan", 996),
        (123, "LA", "Lao People\'s Democratic Republic", 856),
        (124, "LV", "Latvia", 371),
        (125, "LB", "Lebanon", 961),
        (126, "LS", "Lesotho", 266),
        (127, "LR", "Liberia", 231),
        (128, "LY", "Libyan Arab Jamahiriya", 218),
        (129, "LI", "Liechtenstein", 423),
        (130, "LT", "Lithuania", 370),
        (131, "LU", "Luxembourg", 352),
        (132, "MO", "Macao", 853),
        (133, "MK", "Macedonia, the Former Yugoslav Republic of", 389),
        (134, "MG", "Madagascar", 261),
        (135, "MW", "Malawi", 265),
        (136, "MY", "Malaysia", 60),
        (137, "MV", "Maldives", 960),
        (138, "ML", "Mali", 223),
        (139, "MT", "Malta", 356),
        (140, "MH", "Marshall Islands", 692),
        (141, "MQ", "Martinique", 596),
        (142, "MR", "Mauritania", 222),
        (143, "MU", "Mauritius", 230),
        (144, "YT", "Mayotte", 262),
        (145, "MX", "Mexico", 52),
        (146, "FM", "Micronesia, Federated States of", 691),
        (147, "MD", "Moldova, Republic of", 373),
        (148, "MC", "Monaco", 377),
        (149, "MN", "Mongolia", 976),
        (150, "ME", "Montenegro", 382),
        (151, "MS", "Montserrat", 1664),
        (152, "MA", "Morocco", 212),
        (153, "MZ", "Mozambique", 258),
        (154, "MM", "Myanmar", 95),
        (155, "NA", "Namibia", 264),
        (156, "NR", "Nauru", 674),
        (157, "NP", "Nepal", 977),
        (158, "NL", "Netherlands", 31),
        (159, "AN", "Netherlands Antilles", 599),
        (160, "NC", "New Caledonia", 687),
        (161, "NZ", "New Zealand", 64),
        (162, "NI", "Nicaragua", 505),
        (163, "NE", "Niger", 227),
        (164, "NG", "Nigeria", 234),
        (165, "NU", "Niue", 683),
        (166, "NF", "Norfolk Island", 672),
        (167, "MP", "Northern Mariana Islands", 1670),
        (168, "NO", "Norway", 47),
        (169, "OM", "Oman", 968),
        (170, "PK", "Pakistan", 92),
        (171, "PW", "Palau", 680),
        (172, "PS", "Palestinian Territory, Occupied", 970),
        (173, "PA", "Panama", 507),
        (174, "PG", "Papua New Guinea", 675),
        (175, "PY", "Paraguay", 595),
        (176, "PE", "Peru", 51),
        (177, "PH", "Philippines", 63),
        (178, "PN", "Pitcairn", 64),
        (179, "PL", "Poland", 48),
        (180, "PT", "Portugal", 351),
        (181, "PR", "Puerto Rico", 1787),
        (182, "QA", "Qatar", 974),
        (183, "RE", "Reunion", 262),
        (184, "RO", "Romania", 40),
        (185, "RU", "Russian Federation", 7),
        (186, "RW", "Rwanda", 250),
        (187, "BL", "Saint Barthelemy", 590),
        (188, "SH", "Saint Helena", 290),
        (189, "KN", "Saint Kitts and Nevis", 1869),
        (190, "LC", "Saint Lucia", 1758),
        (191, "MF", "Saint Martin", 590),
        (192, "PM", "Saint Pierre and Miquelon", 508),
        (193, "VC", "Saint Vincent and the Grenadines", 1784),
        (194, "WS", "Samoa", 684),
        (195, "SM", "San Marino", 378),
        (196, "ST", "Sao Tome and Principe", 239),
        (197, "SA", "Saudi Arabia", 966),
        (198, "SN", "Senegal", 221),
        (199, "RS", "Serbia", 381),
        (200, "CS", "Serbia and Montenegro", 381),
        (201, "SC", "Seychelles", 248),
        (202, "SL", "Sierra Leone", 232),
        (203, "SG", "Singapore", 65),
        (204, "SX", "Sint Maarten", 721),
        (205, "SK", "Slovakia", 421),
        (206, "SI", "Slovenia", 386),
        (207, "SB", "Solomon Islands", 677),
        (208, "SO", "Somalia", 252),
        (209, "ZA", "South Africa", 27),
        (210, "GS", "South Georgia and the South Sandwich Islands", 500),
        (211, "SS", "South Sudan", 211),
        (212, "ES", "Spain", 34),
        (213, "LK", "Sri Lanka", 94),
        (214, "SD", "Sudan", 249),
        (215, "SR", "Suriname", 597),
        (216, "SJ", "Svalbard and Jan Mayen", 47),
        (217, "SZ", "Swaziland", 268),
        (218, "SE", "Sweden", 46),
        (219, "CH", "Switzerland", 41),
        (220, "SY", "Syrian Arab Republic", 963),
        (221, "TW", "Taiwan, Province of China", 886),
        (222, "TJ", "Tajikistan", 992),
        (223, "TZ", "Tanzania, United Republic of", 255),
        (224, "TH", "Thailand", 66),
        (225, "TL", "Timor-Leste", 670),
        (226, "TG", "Togo", 228),
        (227, "TK", "Tokelau", 690),
        (228, "TO", "Tonga", 676),
        (229, "TT", "Trinidad and Tobago", 1868),
        (230, "TN", "Tunisia", 216),
        (231, "TR", "Turkey", 90),
        (232, "TM", "Turkmenistan", 7370),
        (233, "TC", "Turks and Caicos Islands", 1649),
        (234, "TV", "Tuvalu", 688),
        (235, "UG", "Uganda", 256),
        (236, "UA", "Ukraine", 380),
        (237, "AE", "United Arab Emirates", 971),
        (238, "GB", "United Kingdom", 44),
        (239, "US", "United States", 1),
        (240, "UM", "United States Minor Outlying Islands", 1),
        (241, "UY", "Uruguay", 598),
        (242, "UZ", "Uzbekistan", 998),
        (243, "VU", "Vanuatu", 678),
        (244, "VE", "Venezuela", 58),
        (245, "VN", "Viet Nam", 84),
        (246, "VG", "Virgin Islands, British", 1284),
        (247, "VI", "Virgin Islands, U.s.", 1340),
        (248, "WF", "Wallis and Futuna", 681),
        (249, "EH", "Western Sahara", 212),
        (250, "YE", "Yemen", 967),
        (251, "ZM", "Zambia", 260),
        (252, "ZW", "Zimbabwe", 263);
        SQL;

        DB::unprepared($sql);
    }



}
