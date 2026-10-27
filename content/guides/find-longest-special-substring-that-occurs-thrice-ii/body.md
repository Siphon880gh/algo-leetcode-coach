## Three longest runs

1. Split s into maximal runs; for each letter keep its three longest lengths L1 ≥ L2 ≥ L3 (missing ones are 0).
2. Candidates: L1 − 2 (three copies inside one run), min(L1 − 1, L2) (two from the longest run, one from the next), L3 (one from each).
3. Return the largest positive candidate over all letters, or −1.

Examples → 2, −1, 1. Checked against counting every special substring (part I’s method) on 3,000 random strings.

Counting only whole runs misses overlapping copies: example 1 → −1 instead of 2. n reaches 5 · 10^5, so part I’s O(n²) count is too slow.

Time: O(n)  
Space: O(1) (26 letters × 3)

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
