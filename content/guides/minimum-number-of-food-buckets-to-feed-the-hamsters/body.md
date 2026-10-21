## Greedy placement

For each `H` at `i`:

1. Bucket at `i − 1` already → fed.
2. Else if `i + 1` is empty → bucket at `i + 1`.
3. Else if `i − 1` is empty → bucket at `i − 1`.
4. Else → −1.

Examples → 2, 1, −1. Checked against trying every set of empty cells on random strings.

A bucket on the right can also serve the hamster at `i + 2`, while one on the left cannot help anything later, so the right side is never worse.

Time: O(n)  
Space: O(n) for the marks (O(1) with a skip pointer)

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
