## Expand around the deficit

1. If Σ balance < 0, return −1. If nobody is negative, return 0.
2. i = the negative index; d = −balance[i].
3. For k = 1, 2, …: for each distinct j in {i + k, i − k} (mod n), take t = min(d, balance[j]); cost += t · k; d −= t. Stop when d = 0.

Examples → 4, 6, −1. Checked against a min-cost search on 1,500 random arrays.

Pulling from one direction only: example 2 → 10 instead of 6.

Time: O(n)  
Space: O(1)

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
