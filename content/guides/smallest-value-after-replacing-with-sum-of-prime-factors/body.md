## Replace until fixed

1. Loop: factor `n` by trial division up to √n, summing each prime as many times as it divides.
2. If the sum equals `n`, return `n`; otherwise `n = sum`.

Examples → 5, 3. Checked against tracking the smallest value over 50 replacements for every n up to 3000.

Stopping only at a prime would loop forever on 4, since 2 + 2 = 4. The value never grows, and drops at every step that does not stop, so the last value is the smallest.

Time: O(√n · steps)  
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
