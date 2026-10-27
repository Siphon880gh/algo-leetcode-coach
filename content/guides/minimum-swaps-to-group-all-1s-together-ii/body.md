## Zeros inside the best window

1. `k = Σ nums`; if `k == 0`, return 0.
2. Slide a window of length `k` over `nums + nums` (starts 0 … n − 1), tracking its count of ones.
3. Return `k − max count`.

Examples → 1, 2, 0.

Each swap can move one 1 into the target window in exchange for one 0 leaving it, so the zeros inside the window are exactly the swaps needed.

Time: O(n)  
Space: O(1) with modular indexing

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
