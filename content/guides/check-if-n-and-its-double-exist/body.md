## Look both ways

1. For each `x`: if `2x` in `seen` or (`x` even and `x / 2` in `seen`), return true.
2. Add `x` to `seen`.
3. Return false.

`[10,2,5,3]` → true (10 = 2 · 5). `[3,1,7,11]` → false.

Do not check only `2x`; the larger value may come first. Do not let a single 0 match itself; checking before inserting handles that, while two zeros correctly return true.

Time: O(n)  
Space: O(n)

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
