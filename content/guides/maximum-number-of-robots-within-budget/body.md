## Window, deque, running sum

1. For each `r`: pop smaller-or-equal charge times from the deque’s back, push `r`; `sum += runningCosts[r]`.
2. While `chargeTimes[front] + (r − l + 1) · sum > budget`: drop `l` (pop the front if it is `l`), `sum −= runningCosts[l]`, `l++`.
3. `best = max(best, r − l + 1)`.

Examples → 3, 0. Checked against every window on 400 random cases.

Widening a window never lowers its maximum, its size or its sum, so a window over budget stays over budget when extended, which makes shrinking safe. The cost reaches about 2.5 · 10^14, so use 64-bit.

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
