A table lists email addresses. Report each distinct domain that matches the rule the statement gives (for instance, a required ending) and how many addresses use it. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Substring and group

Using the column names the statement gives:

1. domain = the text after `@` (`SUBSTR(email, INSTR(email, '@') + 1)` in SQLite; `SUBSTRING_INDEX(email, '@', -1)` in MySQL).
2. Filter by the statement’s rule on the domain, `GROUP BY` domain, `COUNT(*)`, ordered as asked.

Constructed check (run in SQLite, rule: ends with .com): a@x.com, b@x.com, c@y.org, d@z.com, e@x.com.au → x.com 2, z.com 1.

Match the ending, not a substring: `LIKE '%.com%'` also keeps x.com.au.

Time: O(n)  
Space: O(number of domains)

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
