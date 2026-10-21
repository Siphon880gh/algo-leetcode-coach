## Rotate while anyone waits

1. Loop while `i < n` or `wait > 0`: add `customers[i]` if any arrive, board `k = min(4, wait)`.
2. `profit += k · boardingCost − runningCost`; `rot += 1`.
3. If `profit > best`, set `best = profit`, `ans = rot`. Return `ans` (−1 if never positive).

`[8,3]`, 5, 6 → 3. `[10,9,6]`, 6, 4 → 7. `[3,4,0,5,1]`, 1, 92 → −1.

Use strict `>` so the smallest rotation count wins ties. Do not stop when customers run out; the waiting queue still needs rotations.

Time: O(n + Σ customers / 4)  
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
