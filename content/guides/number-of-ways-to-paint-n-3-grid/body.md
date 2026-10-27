## Pattern transitions

1. `aba = 6`, `abc = 6` for the first row.
2. Each next row: `aba, abc = 3·aba + 2·abc, 2·aba + 2·abc` (mod 10⁹ + 7).
3. Return `aba + abc`.

`n = 1` → 12. `n = 5000` → 30228214.

Do not enumerate all 27 colourings per row and test pairs for large n without grouping; the two-pattern recurrence is O(n) with tiny constants. Do not forget the modulo.

Time: O(n)  
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
