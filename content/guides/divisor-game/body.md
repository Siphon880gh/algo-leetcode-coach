## Even wins

Return `n % 2 == 0`.

Why:

- `n = 1`: no move, the player loses.
- Even `n`: choose `x = 1`, leaving odd `n − 1`.
- Odd `n`: every divisor `x` is odd, so `n − x` is even.

So the player on even always moves and eventually leaves 1 to the opponent.

A DP over `win[i] = any(not win[i − x])` for divisors `x` gives the same result and is a good check. Do not assume larger moves are better; parity is all that matters.

Time: O(1)  
Space: O(1)

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
