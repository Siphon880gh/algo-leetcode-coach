## Forces

Left to right: `f = 0`. At `R`, `f = n`; at `L`, `f = 0`; at `.`, `f = max(f − 1, 0)`. Add `f` to `force[i]`.

Right to left: `f = 0`. At `L`, `f = n`; at `R`, `f = 0`; at `.`, `f = max(f − 1, 0)`. Subtract `f` from `force[i]`.

Then each cell is `R` if `force[i] > 0`, `L` if it is `< 0`, and `.` if 0.

A closer push arrives sooner, and a larger remaining force means a closer push, so comparing forces is the same as comparing arrival times. A tie means the forces balance and the domino stays up.

**Two-pointer alternative:** look at each segment of dots between its nearest pushed dominoes: `R…R` → all R, `L…L` → all L, `R…L` → fill from both ends with a dot in the middle if odd, `L…R` → stays.

Do not simulate second by second; that is O(n²) in the worst case.

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
