-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2020 at 08:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nonprofits`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nonprofit_id` int(10) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nonprofits`
--

CREATE TABLE `nonprofits` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nonprofits`
--

INSERT INTO `nonprofits` (`id`, `name`, `city`, `state`, `type`, `picture`, `url`, `about`, `author_id`) VALUES
(1, 'Churches Active in Northside', 'Cincinnati', 'OH', 'food and necessities', 'https://volunteer.uc.edu/content/volunteer.uc.edu/agency/46246.jpg?1447773175?area=agency', 'http://www.cainministry.org/', 'Thirteen member churches, from six Cincinnati-area communities, support CAIN with board members, financial help, and volunteers. For 10 consecutive years, CAIN has been highly ranked and received the Top-Rated Award designation from GreatNonprofits, based on reviews from guests, volunteers, donors and other stakeholders. In 1993, CAIN’s pantry served 70 families each month and more than 350 families monthly in 2018. Grace Place welcomed 58 families (65 adults and 97 children) in 2018 and Phil’s Place served over 5000 hot meals.', NULL),
(2, 'The Dragonfly Foundation', 'Cincinnati', 'OH', 'Health Assistance', 'https://dragonfly.org/wp-content/uploads/2018/03/logo_dragonfly_horz.png', 'https://dragonfly.org/', 'The fight for excellence in pediatric cancer treatment is important, but no less important is the commitment we must make to support the families that strive for fulfilling and complete lives during and after treatment. Though treatment may end, and illness may be cured or managed, the long-term effects of factors like internal group tension, familial isolation, post-traumatic stress, the anxiety of recurrence, and the emotional, physical and financial toll on the family unit often linger for years, yes years, to come. While the importance of quality healthcare is a common shared value, we must remember to offer families a holistic, uncompromising, fighting chance at well-being, which is our urgent, passionate mission.', NULL),
(3, 'Save Cats and Obliterate Overpopulation', 'Cincinnati', 'OH', 'Animals', 'https://static.wixstatic.com/media/dfaaff_35808930cf274916a6efb04c0fb295a4~mv2.png/v1/fill/w_299,h_204,al_c,q_85,usm_0.66_1.00_0.01/dfaaff_35808930cf274916a6efb04c0fb295a4~mv2.webp', 'https://www.scoopcat.org/', 'SCOOP, Inc, promotes the compassionate treatment and well-being of the feline population. We support the Cincinnati area\'s cats and kittens through our special-needs cat sanctuary, as well as medical assistance and consultation for people helping community cats (\'stray\' or \'feral\'). As a non-profit, all-volunteer organization, SCOOP is dedicated to helping eliminate suffering and overpopulation among cats through non-lethal methods.', NULL),
(4, 'Stray Animals Adoption Program', 'Newport', 'KY', 'Animals', 'https://volunteer.uc.edu/content/volunteer.uc.edu/agency/83994.jpg?1521649451?area=agency', 'https://adoptastray.com/', 'Provide necessary veterinary care including spay/neuter for dogs and cats and finalize life long adoptions upon recovery. During 2017 we provided veterinary care for and adopted a total of 3,644: 3,207 dogs and puppies and 437 cats and kittens', NULL),
(5, 'Disabled American Veterans Charitable Service Trust', 'Cold Springs', 'KY', 'Veterans Assistance', 'https://cdn.greatnonprofits.org/images/logos/CSTLogo.jpg', 'https://cst.dav.org/', 'For more than 30 years, the DAV Charitable Service Trust has played a critical role in the support of ill and injured veterans, their families and caregivers as they navigate the challenges of life after combat. Each year, the organization assists thousands of America’s heroes through targeted grant support of charitable initiatives across the nation.', NULL),
(6, 'Brighton Center, Inc.', 'Newport', 'KY', 'Job Training', 'https://www.brightoncenter.com/includes/img/brighton-center-logo.png', 'https://www.brightoncenter.com/', 'Brighton Center has a mission to create opportunities for individuals and families to reach self-sufficiency through family support services, education, employment, and leadership. We achieve this by providing critical programs and services that help our community grow and thrive.', NULL),
(7, 'Mentoring Plus', 'Newport', 'KY', 'Academic Assistance', 'https://cdn.greatnonprofits.org/images/logos/1MentoringPluslogoFinal.jpg', 'https://mentoringplus.org/', 'We bring guidance and hope to kids in our community. Our devoted mentors provide high-risk teens with support in a nurturing environment, so together they overcome challenges and achieve success. Learn more about the transformative power of Mentoring Plus with', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nonprofit_id` int(10) UNSIGNED NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` char(1) NOT NULL DEFAULT 's'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(7, 'ryan@gmail.com', '$2y$10$EbOKKJ3plfDv6Stt4zNlo.RkEtlHxh8Zg.862vhUmUlT4.cqd9JCi', 's'),
(8, 'admin@email.com', '$2y$10$lRAxJ6SeW/HEd1dn56kS4Okog23ZV3Vhog3MkClabbzdENsi0LRGK', 'a'),
(11, 'manager@email.com', '$2y$10$YGvLrb801XinwoCAumDV0On/ndfo4LhxQHXV0AbzB14AhmHq9U5eu', 'm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`nonprofit_id`),
  ADD KEY `nonprofit_id` (`nonprofit_id`);

--
-- Indexes for table `nonprofits`
--
ALTER TABLE `nonprofits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`nonprofit_id`),
  ADD KEY `nonprofit_id` (`nonprofit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonprofits`
--
ALTER TABLE `nonprofits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`nonprofit_id`) REFERENCES `nonprofits` (`ID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`nonprofit_id`) REFERENCES `nonprofits` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
