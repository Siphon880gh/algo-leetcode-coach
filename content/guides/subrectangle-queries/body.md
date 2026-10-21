## Two simple designs

1. Direct: `updateSubrectangle` overwrites every cell, which is O(area); `getValue` is O(1).
2. Lazy: append `(r1, c1, r2, c2, v)`; `getValue(r, c)` scans backwards for the first covering update, else returns the original value.

With `[[1,2,1],[4,3,4],[3,2,1],[1,1,1]]`: getValue(0,2) → 1; after setting the whole grid to 5 → 5, 5; after setting (3,0)–(3,2) to 10 → getValue(3,1) 10, getValue(0,2) 5.

Do not scan updates oldest first; the newest covering update wins. Pick by call mix: few reads favour lazy, few writes favour direct.

Time: O(area) or O(updates) per call  
Space: O(rows · cols + updates)

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
