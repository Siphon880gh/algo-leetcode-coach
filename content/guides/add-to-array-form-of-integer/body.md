## Use k as the carry

`i = n − 1`, `res = []`. While `i ≥ 0` or `k > 0`:

- If `i ≥ 0`, `k += num[i]`, `i −= 1`.
- Append `k % 10`; `k //= 10`.

Return `res` reversed.

Folding k into the carry handles k having more digits than `num`.

Do not convert `num` to an integer in fixed-width languages; it has up to 10⁴ digits. Do not stop when `i` reaches −1 if `k` is still positive.

Time: O(max(n, digits of k))  
Space: O(n) for the result

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
