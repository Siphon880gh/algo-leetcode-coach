## Simulation

1. drunk = numBottles; empty = numBottles.
2. While empty ≥ numExchange: empty −= numExchange; numExchange += 1; drunk += 1; empty += 1.
3. Return drunk.

Examples → 15, 13. Checked against searching every order of drinking and exchanging for numBottles < 15, numExchange < 8.

The rate rises after every exchange: trading in batches at a fixed rate gives example 2 → 14 instead of 13.

Time: O(√numBottles) exchanges  
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
