USE [master]
GO
/****** Object:  Database [thesisDB]    Script Date: 05/10/2015 11:00:20 PM ******/
CREATE DATABASE [thesisDB]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'thesisDB', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.SQLEXPRESS\MSSQL\DATA\thesisDB.mdf' , SIZE = 5120KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'thesisDB_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.SQLEXPRESS\MSSQL\DATA\thesisDB_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [thesisDB] SET COMPATIBILITY_LEVEL = 120
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [thesisDB].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [thesisDB] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [thesisDB] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [thesisDB] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [thesisDB] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [thesisDB] SET ARITHABORT OFF 
GO
ALTER DATABASE [thesisDB] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [thesisDB] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [thesisDB] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [thesisDB] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [thesisDB] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [thesisDB] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [thesisDB] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [thesisDB] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [thesisDB] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [thesisDB] SET  DISABLE_BROKER 
GO
ALTER DATABASE [thesisDB] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [thesisDB] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [thesisDB] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [thesisDB] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [thesisDB] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [thesisDB] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [thesisDB] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [thesisDB] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [thesisDB] SET  MULTI_USER 
GO
ALTER DATABASE [thesisDB] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [thesisDB] SET DB_CHAINING OFF 
GO
ALTER DATABASE [thesisDB] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [thesisDB] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [thesisDB] SET DELAYED_DURABILITY = DISABLED 
GO
USE [thesisDB]
GO
/****** Object:  Table [dbo].[tblAdmin]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tblAdmin](
	[adminuser] [varchar](50) NOT NULL,
	[adminpass] [varchar](50) NOT NULL,
 CONSTRAINT [PK_tblAdmin] PRIMARY KEY CLUSTERED 
(
	[adminuser] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tblAnnounce]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tblAnnounce](
	[a_id] [int] IDENTITY(1,1) NOT NULL,
	[a_title] [varchar](50) NOT NULL,
	[a_content] [text] NOT NULL,
	[a_timeposted] [varchar](50) NOT NULL,
 CONSTRAINT [PK_tblAnnounce] PRIMARY KEY CLUSTERED 
(
	[a_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tblAnnounceUserTransact]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblAnnounceUserTransact](
	[transact_id_a] [int] IDENTITY(1,1) NOT NULL,
	[a_id] [int] NOT NULL,
	[visible_member_id] [int] NOT NULL,
 CONSTRAINT [PK_tblAnnounceUserTransact1] PRIMARY KEY CLUSTERED 
(
	[transact_id_a] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[tblDocuments]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tblDocuments](
	[document_id] [int] IDENTITY(1,1) NOT NULL,
	[document_category] [varchar](50) NOT NULL,
	[document_path] [varchar](100) NOT NULL,
	[document_timestamp] [varchar](50) NOT NULL,
	[document_title] [varchar](50) NOT NULL,
	[document_active] [int] NOT NULL,
	[document_filename] [varchar](50) NOT NULL,
 CONSTRAINT [PK_tblDocuments] PRIMARY KEY CLUSTERED 
(
	[document_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tblMessages]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tblMessages](
	[message_id] [int] IDENTITY(1,1) NOT NULL,
	[message_title] [varchar](50) NOT NULL,
	[message_sender_name] [varchar](50) NOT NULL,
	[message_sender_id] [int] NOT NULL,
	[message_content] [text] NOT NULL,
	[message_timestamp] [varchar](50) NOT NULL,
 CONSTRAINT [PK_tblMessages] PRIMARY KEY CLUSTERED 
(
	[message_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tblMessagesSent]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tblMessagesSent](
	[transact_id] [int] IDENTITY(1,1) NOT NULL,
	[sender_id] [int] NOT NULL,
	[sender_message] [text] NOT NULL,
	[sender_timestamp] [varchar](50) NOT NULL,
	[receiver_id] [int] NOT NULL,
 CONSTRAINT [PK_tblMessagesSent] PRIMARY KEY CLUSTERED 
(
	[transact_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tblMessageTransact]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tblMessageTransact](
	[Tmessage_id] [int] IDENTITY(1,1) NOT NULL,
	[receiver_id] [int] NOT NULL,
	[message_id] [int] NOT NULL,
 CONSTRAINT [PK_tblMessageTransact] PRIMARY KEY CLUSTERED 
(
	[Tmessage_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[tblPolicy]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tblPolicy](
	[policy_id] [int] IDENTITY(1,1) NOT NULL,
	[policy_title] [varchar](50) NOT NULL,
	[policy_content] [text] NOT NULL,
	[policy_footer] [varchar](50) NOT NULL,
	[policy_timeupdated] [varchar](50) NOT NULL,
	[policy_header] [varchar](50) NOT NULL,
	[policy_dateposted] [varchar](50) NOT NULL,
 CONSTRAINT [PK_tblPolicy] PRIMARY KEY CLUSTERED 
(
	[policy_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tblUsers]    Script Date: 05/10/2015 11:00:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tblUsers](
	[user_id] [int] IDENTITY(1,1) NOT NULL,
	[user_fname] [varchar](50) NOT NULL,
	[user_lname] [varchar](50) NOT NULL,
	[user_email] [varchar](50) NOT NULL,
	[user_username] [varchar](50) NOT NULL,
	[user_password] [varchar](50) NOT NULL,
	[user_active] [tinyint] NOT NULL CONSTRAINT [DF_tblUsers_user_active]  DEFAULT ((0)),
 CONSTRAINT [PK_tblUsers] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
USE [master]
GO
ALTER DATABASE [thesisDB] SET  READ_WRITE 
GO
