## Score and count together

1. `score[S] = 0`, `count[S] = 1`; obstacles and unreachable cells have count 0.
2. For each other cell, from the bottom-right: `best = max` over reachable neighbours; `count = Σ` counts of those with `best`, mod 10⁹ + 7; `score = best + digit` (E adds 0).
3. Return `[score[E], count[E]]`, or `[0, 0]` if `count[E] = 0`.

`["E23","2X2","12S"]` → `[7,1]`. `["E12","1X1","21S"]` → `[4,2]`. `["E11","XXX","11S"]` → `[0,0]`.

Do not add the counts of all neighbours; only those tied for the best. Do not treat `S` or `E` as digits.

Time: O(n²)  
Space: O(n²)

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
