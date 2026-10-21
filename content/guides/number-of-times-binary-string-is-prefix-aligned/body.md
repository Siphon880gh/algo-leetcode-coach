## Running max

1. `mx = 0`, `count = 0`.
2. For step `i` (1-based) flipping `f`: `mx = max(mx, f)`; if `mx == i`, `count += 1`.

`[3,2,4,1,5]` → 2. `[4,1,2,3]` → 1.

Do not simulate the bit string and check its prefix each step; that is O(n²). Do not use 0-based steps with 1-based positions; keep them aligned.

Time: O(n)  
Space: O(1)

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
