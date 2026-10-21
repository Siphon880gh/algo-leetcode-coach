## Merge backwards as far as possible

1. For each `x`: while the stack is non-empty and `gcd(top, x) > 1`: `x = lcm(top, x)`, pop.
2. Push `x`.
3. Return the stack.

Examples → `[12,7,6]`, `[2,1,1,3]`.

A merged value can become non-coprime with an earlier element, which is why the loop keeps checking the new top. The statement guarantees results stay within 10^8; compute lcm as `top / gcd · x` to stay small.

Time: O(n log max)  
Space: O(n)

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
