## Swap parities after i

1. Totals `E`, `O` of even and odd indices.
2. Scan with running `e`, `o` (sums before `i`); remove `nums[i]` from its parity's after-sum.
3. Fair if `e + (O − o − [i odd]·nums[i]) == o + (E − e − [i even]·nums[i])`; then add `nums[i]` to `e` or `o`.

`[2,1,6,4]` → 1. `[1,1,1]` → 3. `[1,2,3]` → 0.

Do not rebuild the array per index (O(n²)).

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
