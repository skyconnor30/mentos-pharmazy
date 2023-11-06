-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 04:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmazy`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `ordID` int(11) NOT NULL,
  `delivery_type` varchar(255) NOT NULL,
  `delivery_price` int(10) NOT NULL,
  `delivery_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ordID` int(11) NOT NULL,
  `ordName` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `ordDeID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ordID` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(10) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdetail` text NOT NULL,
  `price` double NOT NULL,
  `ptype` varchar(255) NOT NULL,
  `plike` int(10) NOT NULL,
  `pimg` varchar(255) NOT NULL,
  `pquan_stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pname`, `pdetail`, `price`, `ptype`, `plike`, `pimg`, `pquan_stock`) VALUES
(1, 'Blackmores MultiVitamin Active 30 TABS', 'Blackmores แบลคมอร์ส มัลติวิตามิน แอคทีฟ (30 เม็ด) MultiVitamin Active (30 Tab)  คือ วิตามินรวมที่ประกอบด้วย วิตามิน แร่ธาตุ และสารอาหารรวม 23 ชนิด ที่มี ส่วนประกอบของ โคเอนโซม์คิวเทน, ลูทีน,ทอรีน และสารสกัดอาร์ติโชค ช่วยดูแลสุขภาพ เสริมสร้างพลังงานแก่ร่างกาย ต่อต้านอนุมูลอิสระ มีส่วนช่วยในการทำงานของระบบกล้ามเนื้อ เพื่อวัยทำงานที่ต้องการความกระฉับกระเฉง และพร้อมสำหรับการทำงานในแต่ละวัน  ทานครั้งละ 1 เม็ด วันละ 1 ครั้ง หลังอาหาร เช้า ค่ะ', 344.5, 'supplementary-food', 0, 'assets/product/blackmore.jpg', 52),
(2, 'Centrum Dietary Supplement 30 TABS', 'Centrum Dietary Supplement ผลิตภัณฑ์เสริมอาหาร วิตามินและเกลือแร่รวม 22 ชนิด สูตรใหม่ พร้อมเบต้าแคโรทีน ลูทีน และ ไลโคปีน Centrum A to Zinc + Lutein เพราะอาหารและการพักผ่อน ไม่เพียงพอต่อร่างกายจึงควรได้รับอาหารเสริม ประกอบด้วยวิตามินและเกลือแร่รวมถึง 22 ชนิด พร้อมด้วย เบต้า-แคโรทีน, ลูทีน และไลโคปีน ให้วิตามินเอ ในรูปแบบเบต้า-แคโรทีน มีความหลากหลายของวิตามินและเกลือแร่ที่ร่างกายต้องการในแต่ละวัน', 280.34, 'supplementary-food', 1, 'assets/product/centrum.jpg', 23),
(3, 'HOF Colla UC-II 30 TABS', 'HOF Colla UC-II คอลลาเจนสำหรับข้อและกระดูก 30 เม็ด ผลิตภัณฑ์คอลลาเจน ไทพ์ทู สำหรับข้อและกระดูก ช่วยป้องกันการทำลาย และเสริมสร้างกระดูกอ่อนบริเวณข้อต่อ ช่วยลดการอักเสบ และอาการปวดจากข้อกระดูก', 800, 'supplementary-food', 0, 'assets/product/ucii.png', 15),
(4, 'Sara Paracetamol Tablets 500 mg 10 Tab', 'Sara Paracetamol Tablets 500 mg 10 Tab ซาร่า พาราเซตามอล สรรพคุณ ลดไข้ ขนาดและวิธีการใช้:\r\n น้ำหนักน้อยกว่า 34 กก. ให้ปรึกษาแพทย์หรือเภสัชกร\r\n น้ำหนักตั้งแต่ 34 - 50 กินยาครั้งละ 1 เม็ด แต่ละครั้งห่างกันอย่างน้อย 4 ชั่วโมง เฉพาะเวลาปวดหรือมีไข้\r\n น้ำหนักมากกว่า 50 - 67 กินยาครั้งละ หนึ่งเม็ดครึ่ง วันละไม่เกิน 5 ครั้ง แต่ละครั้งห่างกันอย่างน้อย 4 ชั่วโมง เฉพาะเวลาปวดหรือมีไข้\r\n น้ำหนักมากกว่า 67 กินยาครั้งละ 2 เม็ด วันละไม่เกิน 4 ครั้ง แต่ละครั้งห่างกันอย่างน้อย 4 ชั่วโมง เฉพาะเวลาปวดหรือมีไข้', 200.42, 'home-medicine', 0, 'assets/product/sara.jpg', 13),
(5, 'Antacil Gel HH 240 ML', 'Antacil Gel HH แอนตาซิล เยล เอช เอช ลดกรด แสบร้อนกลางอก กรดไหลย้อน ยาสามัญประจำบ้าน สรรพคุณ สำหรับลดกรดและลดแก๊สเคลือบแผลในกระเพาะอาหารและลำไส้เล็กส่วนต้น \r\nบรรเทาอาการปวดท้อง ท้องอืด จุกเสียดแน่น อาหารไม่ย่อย แสบร้อนกลางอกอัน\r\nเนื่องจากกรดไหลย้อนของกรดจากภาวะมีกรดมากเกินในกระเพาะอาหาร\r\nโดยไม่ทำให้เกิดอาการท้องผูก ออกฤทธิ์ภายใน 5 นาที', 55, 'home-medicine', 0, 'assets/product/antacil.png', 36),
(6, 'Eno Orange Flavoured 4.3 g', 'Eno Orange Flavoured อีโน รสส้ม บรรเทาอาการท้องอืด ท้องเฟ้อ 1 ซอง:1 ซอง 4.3 กรัม ลดกรด บรรเทาอาการท้องอืด ท้องเฟ้อเนื่องจากมีกรดมากในกระเพาะอาหาร ขนาดและวิธีใช้\r\nผสมน้ำค่อนแก้วรับประทานหลังหมดฟองฟู่\r\nผู้ใหญ่และเด็กอายุ 12 ปีขึ้นไป ครั้งละ 1 ซอง\r\nรับประทานซ้ำได้อีกภายใน 2 หรือ 3 ชม. ถ้าต้องการ', 15, 'home-medicine', 0, 'assets/product/eno.jpg', 14),
(7, 'CERAVE Foaming Cleanser 236ml.', 'เซราวี CERAVE Foaming Cleanser โฟมทำความสะอาดผิวหน้าและผิวกาย สำหรับผิวธรรมดา-ผิวมัน เป็นสิวง่าย 236ml.(โฟมล้างหน้า) ทำความสะอาดและขจัดความมันส่วนเกินต้นเหตุของการเกิดสิว โดยไม่รบกวนปราการปกป้องผิว ส่วนผสมสำคัญได้แก่ เซราไมด์ที่จำเป็นสามชนิด เสริมเกราะปกป้องผิวแข็งแรง ไฮยาลูโรนิคแอซิด เพื่อผิวชุ่มชื้น และไนอาซินาไมด์ เพื่อลดเลือนรอยแดงจากสิว สูตรปราศจากสบู่ น้ำหอม สูตรไม่ก่อให้เกิดการอุดตัน (Non Comedogenic) และสูตรไฮโปอัลเลอจีนิค ผลิตภัณฑ์ผ่านการทดสอบบนผิวที่บอบบางระคายเคืองง่าย ภายใต้การควบคุมดูแลโดยแพทย์ผู้เชี่ยวชาญทางด้านผิวหนัง และพัฒนาวิจัยค้นคว้าร่วมกับแพทย์ผิวหนัง', 465, 'skin-care', 0, 'assets/product/cerave.jpg', 44),
(8, 'EVES HORSE PLACENTA 15 ml.', 'EVES เซรั่มรกม้า เซรั่มอีฟส์ เซรั่ม บำรุงผิวหน้า ผู้ชาย ผิวหน้าขาว กระจ่างใส ลดรอยสิว ฝ้า กระ จุดด่างดำ หมองคล้ำ อีฟส์ สุดยอดผลิตภัณฑ์บำรุงผิวหน้า ด้วยสารสกัด Horse Placenta จากม้าสายพันธุ์ Thoroughbred ซี่งเป็นสายพันธุ์ม้าแข่งที่ดีที่สุดของประเทศนิวซีแลนด์ ผ่านกรรมวิธีการสกัดด้วยผู้เชี่ยวชาญ และเทคโนโลยีทันสมัยจากประเทศญี่ปุ่น ที่อุดมไปด้วยสารอาหารบำรุงผิวมากมาย อาทิเช่น Amino Acid ซึ่งมีมากกว่าถึง 300 เท่า เมื่อเปรียบเทียบกับปริมาณ Amino Acid ที่ได้จากรกแกะ พร้อมเข้าบำรุงผิวของคุณอย่างลํ้าลึก เสมือน Growth Factor ที่ช่วยบำรุงให้โครงสร้างชั้นผิวค่อยๆ แข็งแรงขึ้น อีกทั้งยังช่วยเติมนํ้าให้ ผิวนุ่มชุ่มชื้น รูขุมขนแลดูกระชับ เรียบเนียน ซึ่งมาในรูปแบบของ Essense ซึมซาบเร็ว ไม่เหนียวเหนอะหนะ', 790, 'skin-care', 0, 'assets/product/eve.jpg', 22),
(9, 'ANESSA SPF50+ PA++++ 90 g.', '[สูตรใหม่] ANESSA อเนสซ่า เพอร์เฟค ยูวี ซันสกรีน สกินแคร์ เจล เอ็น SPF50+ PA++++ 90 ก. กันแดดเนื้อเจลผิวโกลว์ สดชื่น สบายผิว กันแดดเนื้อเจลผิวโกลว์ สดชื่น สบายผิว ล็อคความชุ่มชื่นยาวนาน เพิ่มเกราะปกป้องผิวจากรังสี UV ได้ดียิ่งขึ้น เมื่อผิวต้องเผชิญกับความชื้น เหงื่อ หรือน้ำ ', 759, 'skin-care', 0, 'assets/product/anessa.jpg', 12),
(10, 'Scotch Collagen Plus 170 g.', 'สก๊อต คอลลาเจน พลัส คอลลาเจนผงนวัตกรรมใหม่ ที่รวบรวมสารอาหารเพื่อผิวพรรณ ไว้ 3 ชนิดด้วยกันได้แก่  คอลลาเจนเปปไทด์ และ คอลลาเจนไดเปปไทด์ 5,000 มก. จากประเทศญี่ปุ่น สารสกัดจากซีบัคธอร์น และวิตามิน C 60 มก. สก๊อต คอลลาเจน พลัส เป็นคอลลาเจนผงที่ไม่มีสี ไม่มีกลิ่นสามารถผสมกับอาหารและเครื่องดื่มได้โดยไม่ทำให้อาหารและเครื่องดื่มมีรสชาติเปลี่ยนแปลง', 1833.25, 'supplementary-food', 0, 'assets/product/scotch.jpg', 5),
(11, 'Herbitia Lutein Plus 60 capsules', 'Herbitia Lutein Plus เฮอร์บิเทีย ลูทีน พลัส บรรจุ 60 แคปซูล อาหารเสริม ตัวช่วยฟื้นฟูบำรุงดวงตาแบบเร่งด่วน ด้วยสารสกัด ลูทีน และซีแซนทิน สำหรับผู้มีปัญหาดวงตา และผู้ที่ต้องการบำรุงดวงตาเป็นพิเศษ เหมาะสำหรับ ผู้ที่อยู่หน้าจอนานกว่า 6 ชั่วโมงต่อวัน, ผู้ที่มีปัญหาสายตาสั้น สายตายาว, ผู้ที่ใช้คอนแทคเลนส์เป็นประจำm, ผู้ที่เป็นโรคเกี่ยวกับสายตา เช่น ต้อลม ต้อเนื้อ ต้อหิน และต้อกระจก, ผู้ที่มีอาการตาแห้ง แสบตาง่าย ตาแดงบ่อย, ผู้ที่เห็นจุดดำหรือเส้นใยสีขาวลอยไปมาในอากาศ, ผู้ที่มีอาการตาล้า ตาพร่ามัวง่าย', 629, 'supplementary-food', 0, 'assets/product/herbitia.jpg', 14),
(12, 'Plantae Complete Plant-Protein', 'Plantae Complete Plant-Protein : Active BCAAs รส Matcha 1 กระปุก ขนาด 800g : โปรตีนพืช มัทฉะ ชาเขียว แคลอรี่ต่ำ ความหวานจากธรรมชาติ \"Stevia\" ไม่กระตุ้นอินซูลิน(ผู้ป่วยเบาหวานสามารถทานได้) โปรตีนพืช 5 ชนิด จากถั่วลันเตาคัดพิเศษ ข้าวออร์แกนิค ถั่วเหลือง เมล็ดฟักทอง และเมล็ดทานตะวัน มีโปรตีนสูงถึง 30 g ช่วยเสริมปริมาณโปรตีนที่ควรได้รับในแต่ละวัน มีกรดอะมิโนจำเป็นครบทั้ง 9 ชนิด ที่ร่างกายไม่สามารถสร้างเองได้ และ Plus BCAAs ที่ช่วยในการเสริมสร้างกล้ามเนื้อได้อย่างมีประสิทธิภาพ ลดการบาดเจ็บกล้ามเนื้อจากการออกกำลังกาย', 1590, 'supplementary-food', 0, 'assets/product/plantae.jpg', 17),
(13, 'CoolFever For Adults 6 Sheets', 'CoolFever(คลูฟีเวอร์ผู้ใหญ่) คูลฟีเวอร์ แผ่นเจลลดไข้ สำหรับผู้ใหญ่ 6 ชิ้น คูลฟีเวอร์ แผ่นเจลลดไข้ สำหรับผู้ใหญ่ 6 ชิ้น ติดแน่น สามารถใช้ได้ทันที อ่อนโยนต่อผิว ช่วยลดไข้ได้เป็นอย่างดี ให้ความเย็นยาวนาน 8 ชั่วโมง', 88, 'home-medicine', 0, 'assets/product/coolfever.jpg', 55),
(14, 'SoS Plus S Series', 'SoS Plus S Series เอสโอเอส พลัส รุ่น เอส ซีรีส์ ผ้าก๊อซปิดแผลแบบพร้อมใช้ 8 ซม.x8 ซม.4 แผ่น ใช้ปิดบาดแผลและป้องกันการติดเชื้อ จากแผลที่เกิดจากของมีคม แผลถลอก แผลเย็บ แผลจากไฟไหม้ และแผลจากการผ่าตัด2. ป้องกันการเสียดสีของผิวหนังที่เป็นรอยแดงหรือบอบบาง', 55, 'home-medicine', 0, 'assets/product/sosplus.jpg', 24),
(15, 'Counterpain HR Relieves Muscular Pain 100g', 'Counterpain HR Relieves Muscular Pain 100g ครีมทาบรรเทาอาการปวด ครีมทาแก้ปวดกล้ามเนื้อ ใช้ถูนวดตามร่างกาย ขัดยอก วิงเวียนศีรษะ หน้ามืด ข้อเคล็ด กล้ามเนื้อตึง ขัดยอกหลังการเล่นกีฬา แมลงสัตว์กัดต่อย เป็นเม็ดตุ่มคันตามผิวหนัง ใช้ทาบริเวณหน้าท้อง จะบรรเทาอาการท้องขึ้น จุก เสียด มีกลไกการออกฤทธิ์ โดยตัวยาจะกระตุ้นปลายประสาทรับความรู้สึกถึงความร้อน – อบอุ่น ทำให้เกิดการตอบสนองถึงการบรรเทาอาการปวดลดลง', 299, 'home-medicine', 0, 'assets/product/counterpain.jpg', 25),
(16, 'Cetaphil Oily Skin Cleanser 125 ml', 'Cetaphil Oily Skin Cleanser เซตาฟิล ออยลี่ สกิน คลีนเซอร์ (สำหรับผิวมัน) ลดความมัน สิ่งสกปรก และเครื่องสำอางได้ล้ำลึก เหมาะกับผิวมัน ผิวผสม ผิวเกิดสิวง่าย นวัตกรรมสูตร Gentle Foaming Action ประสิทธิภาพสูงในการลดความมันส่วนเกิน สิ่งสกปรก และเครื่องสำอางบนใบหน้าได้อย่างล้ำลึก โดยไม่ทำให้ผิวแห้งตึง พัฒนามาสำหรับผิวหน้า ใช้ร่วมกับการรักษาสิวได้ผลดียิ่งขึ้น ลดความมันส่วนเกินอย่างได้ผลเมื่อใช้ต่อเนื่อง 2 สัปดาห์', 324, 'skin-care', 0, 'assets/product/cetaphil.png', 24),
(17, 'CLEAR NOSE Acne Care Solution 150ml', 'CLEAR NOSE Acne Care Solution Cleanser 150ml คลีนเซอร์สูตรเพื่อผิวเป็นสิวและผิวแพ้ง่าย ที่ออกแบบมาเพื่อการล้างหน้าที่สะอาดหมดจด จากเคีลยร์โนส ไม่ทิ้งความมันบนใบหน้าและไม่ทําให้ผิวแห้งตึง ปราศจากน้ำหอม และสารที่ก่อให้เกิดการระคายเคือง', 259.55, 'skin-care', 0, 'assets/product/clearnose.jpg', 18),
(18, 'Eucerin pH5 Dry Sensitive Skin Lotion 400ml', 'Eucerin pH5 Dry Sensitive Skin Lotion 400ml (ยูเซอริน โลชั่นบำรุงผิว สำหรับผิวแห้ง ผิวบอบบาง แพ้ง่าย บำรุงผิวนุ่มชุ่มชื้น) ผิวแห้ง บอบบางแพ้ง่ายต้องดูแลเป็นพิเศษเพื่อเสริมเกราะปกป้องผิว ผิวจึงไม่ไวต่อปัจจัยกระตุ้น pH5 Balance System & 5% Dexpanthenol นวัตกรรมที่ไม่เพียงเพิ่มและกักเก็บความชุ่มชื้นในผิว แต่ยังช่วยปรับและคงสมดุลสภาพแวดล้อมในเซลล์ผิว ไว้ที่ค่าตามธรรม่ชาติของผิวสุขภาพดี เพื่อเสริมให้การผลัดเซลล์ผิว เป็นไปอย่างสมบูรณ์ เสริมเกราะปกป้องผิว ผิวจึงไม่ไวต่อปัจจัยกระตุ้นต่างๆ', 477, 'skin-care', 0, 'assets/product/eucerin.jpg', 8),
(19, 'Amino VITAL Energy Gel 100 g', 'Amino VITAL Energy Gel อะมิโนไวทัล เจลพลังงานผสมกรดอะมิโนพร้อมทาน 100 กรัม คืนความสดชื่นในการออกกำลังกายด้วยเจลลี่ฟื้นฟูซ่อมแซมกล้ามเนื้อ เนื้อสัมผัสเจลลี่ ทานง่าย มีส่วนผสมของกรดอะมิโน BCAAs ช่วยเพิ่มความแข็งแรงของกล้ามเนื้อ Amino VITAL แบรนด์ที่มียอดขายอันดับหนึ่งในประเทศญี่ปุ่น เจลพลังงานพร้อมทาน มีส่วนผสมของกรดอะมิโน 3,000 ม.ก. โดยมีกรดอะมิโนหลัก คือ BCAAs ถึง 1,700 ม.ก.มากกว่า 50% ของกรดอะมิโนทั้งหมด ซึ่งเป็นกรดอะมิโนจำเป็น 3 ชนิด ที่ร่างกายสร้างขึ้นเองไม่ได้ ได้แก่ แอล-ลูซีน, แอล-ไอโซลูซีน และ แอล-วาลีน ช่วยลดการสูญเสียกล้ามเนื้อระหว่างการเล่นกีฬา 1 ถุง มี 100 กรัม ให้พลังงาน 110 กิโลแคลลอรี่', 65, 'supplementary-food', 0, 'assets/product/aminovital.jpg', 24),
(20, 'NUUI Fiberry 12,000 mg', 'NUUI WINTER PROMOTION NUUI Fiberry หนุย ไฟเบอร์รี่ 1x10 (1 กล่อง 10 ซอง) ผลิตภัณฑ์เสริมอาหาร หนุย ไฟเบอร์รี่ ใยอาหารเพิ่มกากในระบบทางเดินอาหารช่วยกระตุ้นการขับถ่าย ใยอาหารเพิ่มกากในระบบทางเดินอาหาร ช่วยกระตุ้นการขับถ่าย ฟรุคโตโอลิโกแซคคาร์ไรด์ (FOS) จากเนเธอร์แลนด์ ผ่านการตรวจ GMP กฎหมาย ,ผ่านการวิเคราะห์ข้อมูลโภชนาการ', 525, 'supplementary-food', 0, 'assets/product/nuuifiberry.jpg', 12),
(21, 'HandyHerb Gnite', 'HandyHerb Gnite จีไนท์ สมุนไพรคาโมมายล์ ช่วยให้หลับสนิทตลอดคืน สดชื่นตอนตื่น ขนาดคุ้มค่า (3 แผง 30 แคปซูล) แฮนดี้เฮิร์บ จี’ไนท์ ผลิตภัณฑ์เสริมอาหาร สารสกัดดอกคาโมมายล์และเห็ดหลินจือ ในรูปแบบแคปซูล สมุนไพรธรรมชาติปลอดภัย ช่วยลดอาการนอนหลับไม่สนิท ช่วยให้ร่างกายคลายความวิตกกังวล และเพิ่มระยะเวลาการนอนให้นานขึ้น ทำให้นอนหลับได้ดี', 190, 'supplementary-food', 0, 'assets/product/gnite.jpeg', 22),
(22, 'PERSKINDOL Classic gel 200 ml', 'PERSKINDOL Classic gel 200 ml เพอร์สกินดอล สูตรร้อน ชนิดเจล บรรเทาปวดกล้ามเนื้อ หลอดสีเหลือง บรรเทาอาการ ปวดหลัง ข้ออักเสบ อาการตึงตัวของกล้ามเนื้อ คอเคล็ด เคล็ด ขัดยอก อาการปวดของกล้ามเนื้อ การฟกช้ำ', 212, 'home-medicine', 0, 'assets/product/perskindol.jpg', 13),
(23, 'Tensoplastic 100 Pcs', 'Tensoplastic พลาสเตอร์ปิดแผล ชนิดพลาสติกใสกันน้ำ 100ชิ้น/กล่อง (เทนโซพล๊าสติค)พลาสเตอร์ยา เทนโซพล๊าสติค 1 ชิ้น มีตัวยาคอมิเฟนโบรไมด์ 0.15% ป้องกันเชื้อโรค มีแผ่นใยพิเศษ ป้องกันไม่ให้ติดแผล', 89, 'home-medicine', 0, 'assets/product/tensoplastic.jpg', 9),
(24, 'NEOTICA Balm 25 g', 'NEOTICA BALM ครีมทาบรรเทาอาการปวดกล้ามเนื้อ เคล็ดตามข้อ ครีมบรรเทาปวด ประกอบด้วยตัวยาที่มีสรรพคุณในการบรรเทาอาการปวดกล้ามเนื้อ เคล็ดตามข้อ เช่น ข้อเคล็ด กล้ามเนื้อตึง ขัดยอกหลังเล่นกีฬา รวมถึงแมลงกัดต่อย', 42, 'home-medicine', 0, 'assets/product/neotica.jpg', 12),
(25, 'Hiruscar Post Acne 10 g', 'Hiruscar Post Acne ฮีรูสการ์ โพสต์ แอคเน่ ดูแลผิวที่มีปัญหาสิว คืนความใส เรียบเนียน ป้องกันปัญหาสิวอุดตัน ช่วยให้รอยด่างดำ รอยอักเสบดูจางลง ช่วยให้รอยหลุมสิวแลดูตื้นขึ้น คืนความใส เรียบเนียน ป้องกันปัญหาสิวอุดตัน ด้วยสูตร 3-in-1 Scar Clear Formulation ที่อุดมด้วย 5 ตัวช่วยเพื่อดูแลผิวครบวงจร', 270, 'skin-care', 0, 'assets/product/hiruscar.jpg', 25),
(26, 'CERAVE Moisturising Lotion 88 ml', 'เซราวี CERAVE Moisturising Lotion โลชั่นบำรุงผิว เนื้อสัมผัสบางเบา 88ml.(โลชั่น Moisturising Lotion ผิวชุ่มชื้น) โลชั่นบำรุงผิวให้ความชุ่มชื้นตลอดวันและช่วยฟื้นฟูปราการปกป้องผิวหน้าและกาย สำหรับผิวธรรมดา ผิวมัน ผิวผสมฟื้นบำรุงลิปิดที่จำเป็นต่อความสมดุลและความรู้สึกสบายผิว เติมความชุ่มชื้นและช่วยฟื้นฟูปราการปกป้องผิวด้วยเซราไมด์ที่จำเป็นต่อผิว 3 ชนิด และ MVE Technology ผิวชุ่มชื้นตลอดวัน เนื้อสัมผัสบางเบา ปราศจากน้ำมัน ที่ช่วยเติมความชุ่มชื้นให้แก่ผิวและฟื้นฟูปราการผิวตามธรรมชาติ ด้วยสูตรบางเบาและไม่ก่อให้เกิดการอุดตัน (non-comedogenic) ไม่ก่อให้เกิดอาการแพ้ ปราศจากนำมัน และปราศจากน้ำหอมคิดค้นขึ้นโดยความร่วมมือของแพทย์ผู้เชี่ยวชาญด้านผิวหนังผ่านการรับรองโดย National Eczema Association', 255, 'skin-care', 0, 'assets/product/cerave1.jpg', 20),
(27, 'Smooth E Babyface Gel', 'Smooth E Babyface Gel เจลล้างหน้า สูตรไม่มีฟอง100% เหมาะกับผู้ที่มีผิว บอบบางแพ้ง่าย ไม่มีประจุไฟฟ้า ไม่ทิ้งสารตกค้าง เจลล้างหน้าสูตรอ่อนโยน 100% Non-Ionic ลดการอุดตันรูขุมขน ลดอาการแพ้ระคายเคือง ให้ความชุ่มชื้น เป็นสูตรเดียวที่แพทย์ผิวหนังแนะนำให้ผู้มีปัญหาผิวใช้', 198, 'skin-care', 0, 'assets/product/smoothe.jpg', 42),
(28, 'OMRON HEM-7156T-A', 'ออมรอน เครื่องวัดความดัน เครื่องวัดความดันโลหิตอัตโนมัติเชื่อมต่อบลูทูธได้ รุ่น HEM-7156T DELUXE เพราะความแม่นยำมีความสำคัญในการดูแลสุขภาพ ให้เครื่องวัดความดันโลหิตรุ่น HEM-7156T จาก OMRON ได้ดูแลสุขภาพของคุณ ที่มาพร้อมกับผ้าพันแขน แบบ IntelliWrap สวมใส่ง่าย วัดได้รอบทิศทาง ที่มีความแม่นยำถึง 360 องศา และไม่ต้องกังวลเรื่องการใส่ผ้าพันแขนที่ผิดวิธี อาจเป็นสาเหตุที่ทำให้ค่าที่วัดคลาดเคลื่อนได้ และด้วยเทคโนโลยี IntelliWrap สวมใส่ได้ง่ายเพียงครอบลงที่แขน ทำให้การวัดความดันโลหิตได้เองที่บ้านเป็นไปได้อย่างง่ายดายและแม่นยำเปรียบเสมือนการวัดความดันโลหิตที่โรงพยาบาล! รุ่นนี้สามารถเชื่อมต่อบลูทูธได้', 2650, 'medical-supply', 0, 'assets/product/mdsp-1.png', 22),
(29, 'Medtec Water proof Bandage Spray 40ml', 'Medtec Water proof Bandage Spray 40ml. เมดเทค วอเทอร์ พรูฟ แบนดิจ สเปรย์ 40มล. สเปรย์ปิดแผลกันน้ำ ป้องกันสิ่งสกปรก และ เชื้อโรคเข้าสู่แผล Medtec Waterproof Bandage Spray ฟิลม์ใสกันน้ำได้ 2-3 วัน ช่วยป้องกันสิ่งสกปรก และ เชื้อโรคเข้าสู่แผล สะดวกต่อการพกพา ขนาด 40 มล.', 159, 'medical-supply', 0, 'assets/product/mdsp-2.png', 25),
(30, 'AIR PLUS Soft Premium Multi Color', 'AIR PLUS Soft Premium Multi Color หน้ากากอนามัยคละสี กล่อง40ชิ้น แอร์พลัส AIR PLUS Soft Premium Multi Color แอร์ พลัส หน้ากากอนามัยทางการแพทย์ Surgical Face Mask มีประสิทธิภาพกรองแบคทีเรีย ไวรัส และฝุ่นละอองขนาดเล็กได้ถึง 99% สายคล้องหูแบบแถบ สวมนุ่มสบาย ไม่เจ็บหู ยืดได้ 2.5 เท่า ใส่กระชับเข้ากับรูปใบหน้า', 89, 'medical-supply', 2, 'assets/product/mdsp-3.png', 33),
(31, 'NORMAL Saline 1000 ml', 'NORMAL Saline 1000 ml.(ดัมเบลล์)ฝาเกลียว NORMAL Saline 1000 ml.(ดัมเบลล์)ฝาเกลียว น้ำเกลือใช้ทำความสะอาดบริเวณที่ต้องการ ทำความสะอาดผิว ล้างแผล ล้างจมูก ล้างคอนแทคเลนส์', 40, 'medical-supply', 0, 'assets/product/mdsp-4.png', 52),
(32, 'FUTURO Wrap Around Ankle', 'FUTURO Wrap Around Ankle อุปกรณ์พยุงข้อเท้า Size L สีน้ำตาล. ฟูทูโร่ อุปกรณ์พยุงข้อเท้า ชนิดเพิ่มความกระชับ เนื้อผ้าอ่อนนุ่ม สามารถระบายอากาศและความชื้นได้ดี บรรเทาอาการปวดเมื่อย เคล็ด ขัดยอก ลดอาการบวมบริเวณข้อเท้า', 239, 'medical-supply', 0, 'assets/product/mdsp-5.png', 23),
(33, 'FUTURO Wrap Around Wrist Support 46709', 'FUTURO Wrap Around Wrist Support 46709 อุปกรณ์พยุงข้อมือ ฟูทูโร่ อุปกรณ์พยุงข้อมือ แบบพันข้อ ถักทอแน่นเป็นพิเศษ ใช้วัสดุพิเศษ ปรับกระชับได้ ระบายความชื้นและอากาศได้ดี บรรเทาอาการปวดเมื่อย เคล็ด ขัดยอก ลดอาการบวมบริเวณข้อมือ', 239, 'medical-supply', 2, 'assets/product/mdsp-6.png', 18),
(34, 'FLOWFLEX ATK Nasal/Saliva(Covid)', 'FLOWFLEX ATK Nasal/Saliva(Covid) กล่อง1ชุด. โฟลร์เฟลค ชุดตรวจโควิด19 FLOWFLEX ATK ชุดตรวจโควิด Flowflex ชุดตรวจ ATK แบบ 2 in 1 ตรวจได้ทั้งน้ำลายและทางจมูก สามารถตรวจสายพันธุ์โอไมครอนได้ ความแม่นยำสูง 97.1% สามารถตรวจในระยะเริ่มแรกได้', 42, 'medical-supply', 1, 'assets/product/mdsp-7.png', 16),
(35, 'YUWELL Infrared Thermometer', 'YUWELL Infrared Thermometer ยูเวล อินฟาเรด เทอร์โมมิเตอร์อินฟาเรด รุ่น YT311 YUWELL เทอร์โมมิเตอร์ดิจิตอล เครื่องวัดอุณหภูมิอิเล็กทรอนิกส์ วัดอุณหภูมิทางปากหรือรักแร้ ใช้ได้ทั้งเด็กและผู้ใหญ่ ใช้แบตเตอรี่กระตุ้ม รุ่น LR41 จอแสดงผล LCD ใช้เวลาเปิดเครื่องเพียง 5 วินาที ใช้ระยะเวลาในการตรวจ 10 นาที สามารถแสดงบันทึกข้อมูลการวัดก่อนหน้าได้', 228, 'medical-supply', 0, 'assets/product/mdsp-8.png', 41),
(36, 'NEXCARE COLD HOT PACK 3M', 'NEXCARE COLD HOT PACK 3M เน็กซ์แคร์ คลุ ฮอต แพ็ค 3เอ็ม 2 กล่อง รับฟรี! กล่องซุปเปอร์ล๊อค 1 ใบ เจลประคบร้อน ประคบเย็น ลดอาการปวด บวม ช้ำ 3M Nexcare Cold Hot เจลประคบร้อน-เย็น มีสรรพคุณหลายอย่าง ไม่ว่าจะเป็นคลายปวดเมื่อย ช่วยลดไข้ หรือผ่อนคลายกล้ามเนื้อ และอื่นๆ อีกมากมาย ทั้งนี้ ขึ้นอยู่กับผู้ใช้งานว่าจะต้องการใช้เจลในรูปแบบไหน', 429, 'medical-supply', 1, 'assets/product/mdsp-9.png', 22),
(37, 'YUWELL Pulse Oximeter YX110', 'YUWELL Pulse Oximeter YX110 ยูเวล พลัช ออกซิเมเตอร์ วายเอ็กหนึ่งหนึ่งศูนย์ YUWELL YX110 (Fingertrip Pulse Oximeter) เครื่องวัดออกซิเจนปลายนิ้ว การอ่านที่แม่นยำเชื่อถือได้และรวดเร็ว: ผลลัพธ์ที่สม่ำเสมอซึ่งได้รับการทดสอบและพิสูจน์แล้ว จอแสดงผลดิจิตอลขนาดใหญ่สามารถรับ SpO2 เลือดอัตราชีพจรและผลความเข้มของชีพจรได้อย่างรวดเร็ว', 1125, 'medical-supply', 0, 'assets/product/mdsp-10.png', 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(10) NOT NULL,
  `u_username` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `u_username`, `u_password`, `u_name`, `email`, `address`, `phone`, `gender`, `urole`, `create_at`, `avatar`) VALUES
(1, 'user', '$2y$10$WelvYcHgSGg.NgyT2lCGuO3HOIQC.THVE1OoEz91HZ6UFRTpOjRhm', 'user', 'user@user.com', '10/14', '012-345-6789', 'male', 'user', '2023-09-26 20:10:57', '../assets/avatar/261838676_217194513901808_8599102040805275054_n.jpg'),
(2, 'admin', '$2y$10$lNF0/M0uts9Ir6zDeGsdt.37ZCzW6G.5c2aLW7rluMB9M.MmxcDzS', 'admin', 'admin@admin.com', '10/1134', '045-345-2356', 'female', 'admin', '2023-09-26 20:11:36', 'assets/avatar/female.png'),
(3, 'user2', '$2y$10$gDuJhSdxZicFtA.KyInDpuuusPgpuLc5.14.bw3A8hB9axxQp/mwe', 'user2', 'user2@user2.com', '10/1241', '086-231-2344', 'female', 'user', '2023-09-26 20:11:58', 'assets/avatar/female.png'),
(4, 'peem', '$2y$10$i//4VQa0OtWmfSTJcElNtekB7AkQzSKaDZ3FB2G9hEBJgUQCNEH3m', 'awsdasd', 'peemd@email.com', 'peemd@email.com', '092-717-4056', 'male', 'user', '2023-10-13 09:47:11', 'assets/avatar/male.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `delivery_uid` (`uid`),
  ADD KEY `delivery_ordID` (`ordID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ordID`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`ordDeID`),
  ADD KEY `order_detail_uid` (`uid`),
  ADD KEY `order_detail_pid` (`pid`),
  ADD KEY `order_detail_ordID` (`ordID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ordID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `ordDeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ordID` FOREIGN KEY (`ordID`) REFERENCES `orders` (`ordID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_uid` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ordID` FOREIGN KEY (`ordID`) REFERENCES `orders` (`ordID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_pid` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_uid` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
