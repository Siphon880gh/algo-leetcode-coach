## Valid intervals, then scheduling

1. `first[c]`, `last[c]` for each letter.
2. For each `c`: `a = first[c]`, `b = last[c]`; scan `j` from `a` to `b`; if `first[s[j]] < a`, invalid; else `b = max(b, last[s[j]])`.
3. Sort the valid intervals by end; take each one starting after the previous end.

`"adefaddaccc"` → `["e","f","ccc"]`. `"abbaccd"` → `["bb","cc","d"]` (any order).

Do not keep a large interval that contains a smaller valid one; earliest-end greedy picks the smaller ones, which maximises the count and minimises total length.

Time: O(26 · n)  
Space: O(26)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
