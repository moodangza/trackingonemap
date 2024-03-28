/*
 Navicat Premium Data Transfer

 Source Server         : real
 Source Server Type    : PostgreSQL
 Source Server Version : 130002 (130002)
 Source Host           : localhost:5432
 Source Catalog        : postgres
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 130002 (130002)
 File Encoding         : 65001

 Date: 12/03/2024 16:23:39
*/


-- ----------------------------
-- Table structure for process_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."process_tb";
CREATE TABLE "public"."process_tb" (
  "process_id" int4 NOT NULL DEFAULT nextval('process_tb_process_id_seq'::regclass),
  "job_id" int4 NOT NULL,
  "process_name" text COLLATE "pg_catalog"."default",
  "process_start" date,
  "process_end" date,
  "process_finish" date,
  "detail" text COLLATE "pg_catalog"."default",
  "process_status" varchar COLLATE "pg_catalog"."default",
  "delete_flag" int4,
  "status" int4,
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "deleted_at" timestamp(6)
)
;

-- ----------------------------
-- Records of process_tb
-- ----------------------------
INSERT INTO "public"."process_tb" VALUES (6, 2, 'test2.3', '2024-01-13', '2024-01-13', NULL, 'test2.33333333', '2', 0, NULL, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (3, 1, 'test3', '2024-02-09', '2024-02-09', NULL, 'test3333333333', '2', 0, NULL, NULL, '2024-02-09 07:56:53', '2024-02-09 14:56:53');
INSERT INTO "public"."process_tb" VALUES (39, 3, 'สลค.กลั่นกรองเรื่องเพื่อเสนอ ครม.', '2024-02-02', '2024-03-01', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (40, 3, 'ครม.อนุมัติหลักการ ส่งร่างฯ ให้ สคก.', '2024-02-03', '2024-03-02', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (41, 4, 'สคก.กลั่นกรองเรื่องเพื่อเตรียมประชุม', '2024-02-04', '2024-03-03', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (42, 4, 'ประชุม', '2024-02-05', '2024-03-04', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (43, 4, 'สคก.แจ้งผลการประชุมพร้อมข้อแก้ไข', '2024-02-06', '2024-03-05', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (44, 5, 'ประสานหน่วยงานที่เกี่ยวข้องตรวจสอบ/รับรองแนวเขต', '2024-02-07', '2024-03-06', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (45, 5, 'แก้ไขรายละเอียดในแผนที่', '2024-02-08', '2024-03-07', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (46, 5, 'จัดทำแผนที่ ส่ง สคก.', '2024-02-09', '2024-03-08', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (47, 5, 'แจ้ง สคก.ยืนยันร่างที่ผ่านการตรวจพิจารณา', '2024-02-10', '2024-03-09', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (48, 5, 'สคก.ส่งร่างที่ตรวจแก้แล้วให้ สลค.', '2024-02-11', '2024-03-10', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (49, 6, 'สลค.ส่งร่างที่ตรวจแก้แล้วให้ กษ./กษ.ยืนยันร่างไป สลค.', '2024-02-12', '2024-03-11', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (50, 6, 'สลค.กลั่นกรองเรื่องเพื่อเสนอ ครม.', '2024-02-13', '2024-03-12', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (51, 6, 'ครม.เห็นชอบ', '2024-02-14', '2024-03-13', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (52, 6, 'ส.ป.ก.จัดส่งแผนที่ท้ายร่าง พ.ร.ฎ. ให้ สลค.', '2024-02-15', '2024-03-14', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (53, 6, 'ทานร่างกฎหมาย', '2024-02-16', '2024-03-15', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (54, 7, 'สลค.นำขึ้นทูลเกล้าฯ และประกาศในราชกิจจานุเบกษา', '2024-02-17', '2024-03-16', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (96, 7, 'test2', '2024-04-05', '2024-04-06', NULL, 'ttttttac', NULL, 1, 1, '2024-02-22 09:48:10', '2024-02-22 02:48:10', NULL);
INSERT INTO "public"."process_tb" VALUES (2, 1, 'ประสานหน่วยงานที่เกี่ยวข้อง ', '2024-02-08', '2024-02-09', NULL, 'test2222222', '1', 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (4, 2, 'จัดทำร่าง พ.ร.ฎ.', '2024-02-09', '2024-02-09', NULL, 'test2.111111111', '2', 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (5, 2, 'เสนอ รมว.ลงนาม', '2024-01-12', '2024-01-12', NULL, 'test2.2222222', '2', 1, 1, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (97, 7, 'test2', '2024-04-05', '2024-04-06', NULL, 'ttttttac', NULL, 1, 1, '2024-02-22 09:48:23', '2024-02-22 02:48:23', NULL);
INSERT INTO "public"."process_tb" VALUES (1, 1, 'สำรวจข้อมูล เอกสารประกอบ', '2024-02-01', '2024-02-02', '2024-02-09', 'test11111111', '1', 1, 2, NULL, NULL, NULL);
INSERT INTO "public"."process_tb" VALUES (107, 7, 'gdsdssd', '2024-04-06', '2024-04-07', NULL, 'bdfsdwsss', NULL, 1, 1, '2024-02-22 10:12:01', '2024-02-22 03:12:01', NULL);
INSERT INTO "public"."process_tb" VALUES (106, 7, 'test64', '2024-04-08', '2024-04-09', NULL, 'tgdffff', NULL, 0, 1, '2024-02-22 10:11:23', '2024-02-27 06:24:11', '2024-02-27 13:24:11');
INSERT INTO "public"."process_tb" VALUES (105, 7, 'tsettttt', '2024-04-06', '2024-04-08', NULL, 'testhhhhh', NULL, 0, 1, '2024-02-22 10:10:36', '2024-02-27 06:24:23', '2024-02-27 13:24:23');
INSERT INTO "public"."process_tb" VALUES (80, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 14:23:31', '2024-02-21 07:23:31', NULL);
INSERT INTO "public"."process_tb" VALUES (81, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 14:26:23', '2024-02-21 07:26:23', NULL);
INSERT INTO "public"."process_tb" VALUES (82, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 14:56:45', '2024-02-21 07:56:45', NULL);
INSERT INTO "public"."process_tb" VALUES (83, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 14:57:48', '2024-02-21 07:57:48', NULL);
INSERT INTO "public"."process_tb" VALUES (84, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 15:20:56', '2024-02-21 08:20:56', NULL);
INSERT INTO "public"."process_tb" VALUES (85, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 15:21:28', '2024-02-21 08:21:28', NULL);
INSERT INTO "public"."process_tb" VALUES (86, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 15:22:26', '2024-02-21 08:22:26', NULL);
INSERT INTO "public"."process_tb" VALUES (87, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 15:22:47', '2024-02-21 08:22:47', NULL);
INSERT INTO "public"."process_tb" VALUES (88, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 15:23:25', '2024-02-21 08:23:25', NULL);
INSERT INTO "public"."process_tb" VALUES (89, 7, 'test', '2024-04-05', '2024-04-06', NULL, 'fgdsgvfv', NULL, 0, 1, '2024-02-21 15:44:05', '2024-02-21 08:44:05', NULL);
INSERT INTO "public"."process_tb" VALUES (90, 7, 'test', '2024-04-06', '2024-04-06', NULL, 'gfgfd', NULL, 0, 1, '2024-02-21 15:44:47', '2024-02-21 08:44:47', NULL);
INSERT INTO "public"."process_tb" VALUES (91, 7, 'test', '2024-04-06', '2024-04-06', NULL, 'gfgfd', NULL, 0, 1, '2024-02-21 15:49:27', '2024-02-21 08:49:27', NULL);
INSERT INTO "public"."process_tb" VALUES (92, 7, 'test', '2024-04-06', '2024-04-06', NULL, 'gfgfd', NULL, 0, 1, '2024-02-21 15:50:18', '2024-02-21 08:50:18', NULL);
INSERT INTO "public"."process_tb" VALUES (93, 7, 'test', '2024-04-06', '2024-04-06', NULL, 'gfgfd', NULL, 0, 1, '2024-02-21 15:51:30', '2024-02-21 08:51:30', NULL);
INSERT INTO "public"."process_tb" VALUES (94, 7, 'test', '2024-04-06', '2024-04-06', NULL, 'gfgfd', NULL, 0, 1, '2024-02-21 15:51:56', '2024-02-21 08:51:56', NULL);
INSERT INTO "public"."process_tb" VALUES (95, 7, 'test', '2024-04-06', '2024-04-06', NULL, 'gfgfd', NULL, 0, 1, '2024-02-21 15:51:57', '2024-02-21 08:51:57', NULL);
INSERT INTO "public"."process_tb" VALUES (98, 7, 'tsttttt', '2024-04-05', '2024-04-07', NULL, 'ttdfgsgvfdbgvfd', NULL, 0, 1, '2024-02-22 09:48:55', '2024-02-22 02:48:55', NULL);
INSERT INTO "public"."process_tb" VALUES (99, 7, 'tsttttt', '2024-04-05', '2024-04-07', NULL, 'ttdfgsgvfdbgvfd', NULL, 0, 1, '2024-02-22 09:52:34', '2024-02-22 02:52:34', NULL);
INSERT INTO "public"."process_tb" VALUES (100, 3, 'gfgfdbgbvbv', '2024-01-02', '2024-01-02', NULL, 'test3', NULL, 0, 1, '2024-02-22 10:01:33', '2024-02-22 03:01:33', NULL);
INSERT INTO "public"."process_tb" VALUES (101, 3, 'test64', '2024-01-02', '2024-01-02', NULL, 'test66', NULL, 0, 1, '2024-02-22 10:03:52', '2024-02-22 03:03:52', NULL);
INSERT INTO "public"."process_tb" VALUES (102, 7, 'test68', '2024-04-05', '2024-04-06', NULL, 'test67', NULL, 0, 1, '2024-02-22 10:05:03', '2024-02-22 03:05:03', NULL);
INSERT INTO "public"."process_tb" VALUES (103, 7, 'test22', '2024-04-06', '2024-04-06', NULL, 'test33', NULL, 0, 1, '2024-02-22 10:07:14', '2024-02-22 03:07:14', NULL);
INSERT INTO "public"."process_tb" VALUES (104, 7, 'test2222', '2024-04-06', '2024-04-07', NULL, 'test3333', NULL, 0, 1, '2024-02-22 10:08:53', '2024-02-22 03:08:53', NULL);
INSERT INTO "public"."process_tb" VALUES (108, 1, 'test1234', '2023-12-21', '2023-12-23', NULL, 'test', NULL, 1, 1, '2024-02-29 10:49:08', '2024-02-29 03:49:08', NULL);

-- ----------------------------
-- Indexes structure for table process_tb
-- ----------------------------
CREATE INDEX "process_tb_job_id_idx" ON "public"."process_tb" USING btree (
  "job_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);
