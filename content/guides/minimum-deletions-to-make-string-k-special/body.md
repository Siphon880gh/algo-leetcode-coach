## Enumerate the floor

1. c = letter counts (at most 26).
2. For each f in c: cost = Σ (v for v < f) + Σ (v − f − k for v > f + k). Return the minimum.

Examples → 3, 2, 1. Checked against trying every kept count per letter on 400 random short words.

Dropping a rare letter entirely can be cheaper: only trimming the frequent letters down to the rarest + k gives example 1 → 4 instead of 3.

Time: O(n + 26²)  
Space: O(26)

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
