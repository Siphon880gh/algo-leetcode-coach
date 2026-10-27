## State BFS

1. Start (S, 0, energy). A move needs energy > 0; it costs 1, or refills to full on R; landing on L adds its bit.
2. Push (cell, mask, e) only if e beats the best energy recorded for (cell, mask).
3. The first popped state with every bit set gives the answer; −1 if the queue empties.

Examples → 2, 3, −1. Checked against BFS over full states on 400 random rooms.

Ignoring energy: example 3 → 4 instead of −1.

Time: O(m · n · 2^L · energy)  
Space: O(m · n · 2^L)

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
