## One REGEXP

1. `WHERE mail REGEXP '^[A-Za-z][A-Za-z0-9_.-]*@leetcode[.]com$'`.
2. Make it case-sensitive (`REGEXP_LIKE(mail, pattern, 'c')` or a binary collation), so `@LeetCode.com` fails.

The example keeps winston@, bella-@, and sally.come@leetcode.com, and rejects a missing domain, a `#`, gmail, and a leading period.

Do not leave the dot unescaped; `.` matches any character. Do not forget the anchors; otherwise a valid prefix inside a longer string passes.

Time: O(rows · length)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
