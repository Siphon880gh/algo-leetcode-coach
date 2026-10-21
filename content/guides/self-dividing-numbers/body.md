## Peel digits

For `x` from `left` to `right`:

- `t = x`. While `t > 0`: `d = t % 10`. If `d == 0` or `x % d ≠ 0`, reject `x`. Otherwise `t //= 10`.
- If no digit rejected it, add `x` to the answer.

The range is at most 10⁴ numbers with up to 5 digits each, so brute force is the intended solution.

Do not divide by a 0 digit; check `d == 0` first. Do not test the digits of `t` against `t`; always divide the original `x`.

Time: O((right − left) · digits)  
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
