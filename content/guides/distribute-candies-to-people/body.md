## Give until it runs out

`ans = [0] · n`, `give = 1`, `i = 0`. While `candies > 0`:

- `g = min(give, candies)`.
- `ans[i % n] += g`; `candies −= g`.
- `give += 1`; `i += 1`.

Return `ans`.

After `t` handouts, `t(t + 1)/2` candies are gone, so `t` is about `√(2 · candies)`, at most about 45,000 for 10⁹ candies.

A closed form via full rounds exists, but the simulation is simpler and fast enough. Do not forget that the final handout may be smaller than `give`.

Time: O(√candies + n)  
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
