## Independent dimensions

1. Sort each cut list.
2. `mh = max gap over [0, cuts…, h]`; `mv` likewise with `w`.
3. Return `mh · mv mod 1e9+7` (use 64-bit before the modulo).

h = 5, w = 4, `[1,2,4]`, `[1,3]` → 4. `[3,1]`, `[1]` → 6. `[3]`, `[3]` → 9.

Do not forget the gaps to the edges 0 and h (or w). Do not take the modulo of the gaps first; take it after multiplying.

Time: O(H log H + V log V)  
Space: O(1) extra

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
