## Numeric order without parsing

Sort by `(len(s), s)` descending; return the `k`-th.

`["3","6","7","10"], 4` → `"3"`. `["2","21","12","1"], 3` → `"2"`. `["0","0"], 2` → `"0"`.

Plain string sort is wrong: `"10" < "3"` lexicographically. Duplicates count separately, which a plain sort handles naturally. Numbers can have 100 digits, too long for fixed-width integers.

Time: O(n log n · L)  
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
