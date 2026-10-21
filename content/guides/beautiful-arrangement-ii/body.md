## Shrinking differences

Take the numbers `1 … k + 1` and alternate from both ends: `1, k + 1, 2, k, 3, …`. The gaps are `k, k − 1, k − 2, …, 1`, exactly `k` distinct values.

Then append `k + 2, k + 3, …, n` in order. Each new gap is 1, which is already in the set, and the first appended gap (from the last zigzag value to `k + 2`) is also at most `k`. Check: the zigzag ends in the middle of `1 … k + 1`, so the jump to `k + 2` is small.

With two pointers `l = 1`, `r = k + 1`, take `l` then `r` alternately until they meet.

Do not search permutations; `n` is up to 10⁴. Do not zigzag over all `n` numbers; that creates `n − 1` distinct differences, not `k`.

Time: O(n)  
Space: O(1) beyond the output

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
