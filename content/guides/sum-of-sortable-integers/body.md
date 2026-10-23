## Per divisor

1. For each k dividing n, for each block b of length k:
   - count i with b[i] > b[(i + 1) mod k]; more than 1 fails.
   - max of the previous block > min(b) fails.
2. Add k when no block fails.

Examples → 3, 0, 3. Checked against trying every rotation on 2,000 random arrays.

Counting descents without the wrap from the last to the first: constructed check (run in code) [1, 3, 2] → 3 instead of 0.

Time: O(n · d(n)), d(n) = number of divisors  
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
