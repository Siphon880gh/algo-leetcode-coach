`transactions[i] = [from, to, amount]`, 1 to 8 transactions, person IDs below 12, amounts 1 to 100. Return the fewest transactions that settle everyone's debts. `[[0,1,10],[2,0,5]]` → 2. `[[0,1,10],[1,0,1],[1,2,5],[2,0,5]]` → 1 (person 1 pays person 0 four). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Net balances, then split into zero-sum groups

Only each person's net balance matters: `bal[from] −= amount`, `bal[to] += amount`. Drop people at 0. Let `m` be how many remain (at most 12 here, since IDs are below 12).

A group of `k` people whose balances sum to zero can always settle in `k − 1` transfers (each payment zeroes one person). So the answer is `m − (max number of disjoint zero-sum groups)`.

Bitmask DP: for every subset mask, compute its sum. For a zero-sum mask, `f[mask] = popcount(mask) − 1`, then improve it by splitting into two zero-sum parts: `f[mask] = min(f[sub] + f[mask ^ sub])` over submasks `sub`. Answer `f[full]`. Iterating all submasks of all masks is O(3^m).

Backtracking also works: fix the first nonzero balance `i`, try settling it against each later `j` with the opposite sign, recurse, and skip duplicate balances.

Do not greedily match largest debtor with largest creditor — it is not always optimal. Do not keep zero-balance people in the state.

Time: O(3^m)  
Space: O(2^m)

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
