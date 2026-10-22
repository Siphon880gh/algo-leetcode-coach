You are given the power of each of a small number of monsters. You start with no mana, and each day your mana grows by your current gain, which starts at 1. When your mana is at least a monster’s power you can defeat it; that resets your mana to 0 and raises your gain by 1. Return the fewest days needed to defeat every monster; the exact rules are in the official statement. For instance, [3,1,4] → 4 and [1,2,4,9] → 6. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## The set decides the gain

1. `dp[0] = 0`; every other mask starts at infinity.
2. For each mask, `g = popcount(mask) + 1`; for each monster `i` not in it: `dp[mask | i] = min(dp[mask | i], dp[mask] + ceil(power[i] / g))`.
3. Return `dp[all]`.

Constructed checks (verified against every kill order on 300 random small cases): the cases above → 4, 6.

Defeating monsters in increasing power is not optimal: for [3,1,4] it takes 1 + 2 + 2 = 5 days, while 1, then 4, then 3 takes 1 + 2 + 1 = 4. The mask DP tries every order at the cost of 2^n · n.

Time: O(2^n · n)  
Space: O(2^n)

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
