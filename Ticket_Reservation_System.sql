-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 15-12-11 08:32
-- 서버 버전: 5.5.44-0ubuntu0.14.04.1
-- PHP 버전: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `Ticket Reservation System`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 테이블의 덤프 데이터 `admin`
--

INSERT INTO `admin` (`idx`, `id`, `password`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- 테이블 구조 `book_info`
--

CREATE TABLE IF NOT EXISTS `book_info` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `play_times_idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `num_ticket` int(11) NOT NULL,
  `seat` varchar(20) NOT NULL,
  `deposit` tinyint(1) DEFAULT NULL,
  `book_time` datetime NOT NULL,
  `entrance` tinyint(1) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 테이블의 덤프 데이터 `book_info`
--

INSERT INTO `book_info` (`idx`, `play_times_idx`, `user_idx`, `num_ticket`, `seat`, `deposit`, `book_time`, `entrance`) VALUES
(1, 1, 1, 1, '0,1', 0, '0000-00-00 00:00:00', 0),
(2, 1, 1, 3, '5,2', 0, '0000-00-00 00:00:00', 0),
(3, 2, 1, 1, '0,1', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `cannot_seat`
--

CREATE TABLE IF NOT EXISTS `cannot_seat` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `place_idx` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `col` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 테이블의 덤프 데이터 `cannot_seat`
--

INSERT INTO `cannot_seat` (`idx`, `place_idx`, `row`, `col`) VALUES
(1, 1, 0, 0),
(2, 1, 1, 1),
(3, 1, 2, 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `host` varchar(50) NOT NULL,
  `leader` varchar(4) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 테이블의 덤프 데이터 `client`
--

INSERT INTO `client` (`idx`, `id`, `password`, `host`, `leader`, `phone`) VALUES
(1, 'gd', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '꾼들', '전환희2', '01022445124'),
(2, 'as', 'asasas', '어메이징스토리', '김주은', '1084515351'),
(3, 'ho', '334e', '한동오케스트라', '신성만', '1055554441'),
(4, 'ggundle', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '꾼들', '이성경', '1034875314'),
(5, 'client', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'SE', '이성경', '010-4937-7853'),
(6, 'as_host', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '어메이징 스토리', '이성경', '020-8374-3836');

-- --------------------------------------------------------

--
-- 테이블 구조 `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `api_token` varchar(255) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `is_google` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 테이블의 덤프 데이터 `customer`
--

INSERT INTO `customer` (`idx`, `email`, `password`, `name`, `phone_number`, `api_token`, `device_token`, `is_google`) VALUES
(1, 'yjy@gmail.com', '1234', '유지연', '01035956335', '', '', 0),
(2, 'lsk@gmail.com', '1234', '이성경', '01034616845', '', '', 0),
(3, 'kye@gmail.com', '1234', '김영은', '01046511225', '', '', 0),
(4, 'kys@gmail.com', '12345', '성금영', '01044112668', '', '', 0),
(6, 'leesk0502@naver.com', 'bf56476a6ef581b8b3b2c29bbf723989daab7ffbf921c52563c9aae3df1377b3', '이성경', '01034875314', '79bf716afffe7c49548758fb5509bdb0d219ab3baabadd9175dfc9bbdb21c232', '', 0),
(7, 'leesk0502@gmail.com', '', '이성경', '', 'd59de316b8625d6e11f2d5569669daf1da6d583a4d38998edc4cf23f9f5e9580', 'fi4dxnzr-qg:APA91bHXyU2I-VQk5hbGVpB14EFHqBjuB1luj911b03bT0ZZX88_R-4T-6pKsK644s0DSI1tykhcX-Hi3DJFrNbUW4MI8IbcrYp0PRUlsmlgQezZ6uQ7s-LlhHMck6kI4deZFk3Xgc0G', 1),
(11, 'leesk0502@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '테스트', '01012345678', 'c62e4a9086224c6b50b44060af0d5c34dbd5acbcb7340ec4d329a7608a36dba6', 'eWD50YjV48U:APA91bEgDLcdpt2Y4RIRtCncbduLH5x1JRwjZhducPYqZQ6sqORsfew9vncVQh7GkYJ105UFy8z73AyrKbxqKV4KiqLewXJ2isuggFGRqqfsUbO92S5Q7ReHfrvWWBOy3ga2V_YCwOYl', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `idx` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `files`
--

INSERT INTO `files` (`idx`, `filename`, `realname`) VALUES
(0, 'data/3bb95c509a082d1da826b7343ccacb53db37e25c', 'logo2.jpg'),
(0, 'data/19c4fe7f3f28d2697165ead87e58f1dd46c88514', 'logo2.jpg'),
(0, 'data/47b6d798ad69cab6e47484eaaa9b32e049cdc932', 'logo1.jpg'),
(0, 'data/6c118277b031a3a90bec99c244694c0bd1a6f6ae', 'logo1.jpg'),
(0, 'data/24697de307df8dcf7cf25344ec7d10eed0c53989', 'logo1.jpg'),
(0, 'data/22f9a460adaf1e21b861f16dd5581556347e75fc', 'logo1.jpg'),
(0, 'data/747c4ae048e8f88249cf3411558fc3d7f846438d', 'logo1.jpg'),
(0, 'data/65f1eff0d69d2c9eb42829d07f36652b140cde52', 'logo1.jpg'),
(0, 'data/5b6fbbaa6f840bfb7a9d920ee90bde0583737ad3', 'logo1.jpg'),
(0, 'data/c09a9ca06157b7cba156f9ef7d6ae898f7964f8a', 'logo1.jpg'),
(0, 'data/63089f8e400b1bc11de3e3308ba12dbdeb3f90ef', 'logo1.jpg'),
(0, 'data/0ad981d32aeb3bec4db65fdb1432f6426368ec7e', 'movie_image5.jpg'),
(0, 'data/eec7e723ee472af059b2763e39d0c2679eddd6df', '20130508000625_0_59_20130508111542.jpg'),
(0, 'data/3972d88ab58df649be53f6b01dfe50447bbf4a69', '포스터이미지.jpg');

-- --------------------------------------------------------

--
-- 테이블 구조 `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `chapel` tinyint(1) NOT NULL,
  `total_seat` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `col` int(11) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 테이블의 덤프 데이터 `place`
--

INSERT INTO `place` (`idx`, `name`, `chapel`, `total_seat`, `row`, `col`) VALUES
(1, '학관104호', 0, 100, 10, 10),
(2, '학관101호', 0, 80, 8, 10),
(3, '채플', 1, 1000, 20, 50);

-- --------------------------------------------------------

--
-- 테이블 구조 `play_info`
--

CREATE TABLE IF NOT EXISTS `play_info` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `place_idx` int(11) NOT NULL,
  `client_idx` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `fee` int(11) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `contents` longtext NOT NULL,
  `account` int(20) NOT NULL,
  `confirm` tinyint(1) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 테이블의 덤프 데이터 `play_info`
--

INSERT INTO `play_info` (`idx`, `place_idx`, `client_idx`, `title`, `fee`, `thumbnail`, `contents`, `account`, `confirm`) VALUES
(1, 1, 1, '한여름밤의꿈', 3000, 'data/movie_image.jpg', '', 0, 1),
(2, 2, 2, '웃어라무덤아', 5000, 'data/movie_image2.jpg', '', 0, 1),
(3, 3, 3, '오케스트라정기공연', 5000, 'data/movie_image3.jpg', '', 0, 1),
(4, 2, 2, '오싹한흥신소', 4500, 'data/movie_image4.jpg', '', 0, 1),
(15, 2, 1, '공연등록3', 2000, 'data/63089f8e400b1bc11de3e3308ba12dbdeb3f90ef', '공연등록3 내용', 0, 1),
(16, 0, 1, 'd', 0, '', '', 0, 0),
(17, 1, 4, 'Test Title', 2000, 'data/0ad981d32aeb3bec4db65fdb1432f6426368ec7e', 'Test1234', 0, 1),
(18, 1, 5, '집으로', 2500, 'data/eec7e723ee472af059b2763e39d0c2679eddd6df', '집으로 가는 길입니다. 많이 봐주세요! :)', 0, 1),
(19, 1, 6, '나는 나다', 5000, 'data/3972d88ab58df649be53f6b01dfe50447bbf4a69', '공연입니다.', 0, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `play_times`
--

CREATE TABLE IF NOT EXISTS `play_times` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `play_info_idx` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 테이블의 덤프 데이터 `play_times`
--

INSERT INTO `play_times` (`idx`, `play_info_idx`, `start_time`) VALUES
(1, 1, '2015-11-17 16:00:00'),
(2, 1, '2015-11-17 16:00:00'),
(4, 2, '2015-11-04 00:00:00'),
(5, 3, '2015-11-18 00:00:00'),
(6, 4, '2015-11-18 00:00:00'),
(14, 15, '2015-12-16 16:00:00'),
(15, 17, '2015-12-15 16:00:00'),
(16, 18, '2015-12-08 18:00:00'),
(17, 18, '2015-12-08 19:30:00'),
(18, 18, '2015-12-08 21:00:00'),
(19, 19, '2015-12-08 17:00:00'),
(20, 19, '2015-12-08 20:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
