--
-- Database: `justloveplayandlearncentre`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
);

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `admission_id`int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `admission_date` date NOT NULL,
  `care_type` varchar(255) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `child_dob` date NOT NULL,
  `child_age` varchar(20) DEFAULT NULL,
  `guardian_one_relationship` varchar(255) NOT NULL,
  `guardian_one_name` varchar(255) NOT NULL,
  `guardian_one_home_address` text NOT NULL,
  `guardian_one_id_number` varchar(255) NOT NULL,
  `guardian_one_email` varchar(255) NOT NULL,
  `guardian_one_home_tel` varchar(20) NOT NULL,
  `guardian_one_work_tel` varchar(20) NOT NULL,
  `guardian_one_cellphone` varchar(20) NOT NULL,
  `guardian_one_company` varchar(255) NOT NULL,
  `guardian_one_work_address` text NOT NULL,
  `guardian_two_relationship` varchar(255) NOT NULL,
  `guardian_two_name` varchar(255) NOT NULL,
  `guardian_two_home_address` text NOT NULL,
  `guardian_two_id_number` varchar(255) NOT NULL,
  `guardian_two_email` varchar(255) NOT NULL,
  `guardian_two_home_tel` varchar(20) NOT NULL,
  `guardian_two_work_tel` varchar(20) NOT NULL,
  `guardian_two_cellphone` varchar(20) NOT NULL,
  `guardian_two_company` varchar(255) NOT NULL,
  `guardian_two_work_address` text NOT NULL,
  `reasons` text NOT NULL,
  `application_date` date NOT NULL,
  `parent_signature` text NOT NULL,
  `child_id` bigint(20) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `home_language` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `num_children` int(11) NOT NULL,
  `other_children_ages` varchar(255) NOT NULL,
  `birth_problems` text NOT NULL,
  `contagious_illnesses` text NOT NULL,
  `allergies` text NOT NULL,
  `family_doctor` varchar(255) NOT NULL,
  `morning_bringer` varchar(255) NOT NULL,
  `afternoon_fetcher` varchar(255) NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `previous_school` varchar(255) NOT NULL,
  `school_telephone` varchar(20) NOT NULL,
  `indemnity_child_name` varchar(255) NOT NULL,
  `yearly_fees_months` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
);


--
-- Table structure for table `diary`
--

CREATE TABLE `diary` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `diary_description` varchar(1000) NOT NULL,
  `date` date NOT NULL
);

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `events_file` varchar(255) NOT NULL,
  `event_date` date NOT NULL
);

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `c_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `image_description` varchar(255) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_date` date DEFAULT NULL
);

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` varchar(13) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
);

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name_of_resource` varchar(255) NOT NULL,
  `resource_date` date NOT NULL,
  `resource_file` varchar(255) NOT NULL,
  `resource_name` varchar(255) NOT NULL
);

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `admin_response` text NOT NULL,
  `parent_email` varchar(255) NOT NULL,
  `parent_first_name` varchar(255) NOT NULL,
  `parent_last_name` varchar(255) NOT NULL,
  `parent_phone` varchar(20) NOT NULL,
  `query` text NOT NULL
);



--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `tour_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `status` varchar(100) DEFAULT NULL
);
