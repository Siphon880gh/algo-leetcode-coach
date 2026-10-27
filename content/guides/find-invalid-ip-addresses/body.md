## One pattern

1. O = `(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])`; keep rows where `ip NOT REGEXP '^(O[.]){3}O$'` (with O written out).
2. `GROUP BY ip`, `COUNT(*) AS invalid_count`; order by invalid_count DESC, ip DESC.

Example (run in SQLite with a REGEXP function added) → (256.1.2.3, 2), (192.168.001.1, 2), (192.168.1, 1).

Ordering ip ascending on ties: 192.168.001.1 comes before 256.1.2.3.

Time: O(n log n)  
Space: O(n)

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
