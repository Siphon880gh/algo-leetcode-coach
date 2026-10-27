Each hero has a power; each monster has a power and a number of coins. A hero defeats every monster weaker than them and collects all those coins. Return, for each hero, the total coins they can collect. How equal power is treated and the limits are in the official statement. For instance, heroes [1, 4, 2] against monsters [1, 1, 5, 2, 3] with coins [2, 3, 4, 5, 6] → [5, 16, 10] if a tie counts as a win. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Prefix sums

This assumes a hero beats a monster of equal power. Use a strict bound if the statement says otherwise.

1. Sort (power, coins) by power; prefix sums P.
2. For hero h: `i` = number of monsters with power ≤ h (bisect right); answer `P[i]`.

Constructed checks (run in code): the example above; 300 random cases match summing directly.

A strict bound changes ties: the example → [0, 16, 5]. Totals can be large, so use 64-bit.

Time: O((n + m) log m)  
Space: O(m)

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
