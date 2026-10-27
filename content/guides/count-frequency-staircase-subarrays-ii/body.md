## Example first

nums = [6, 6, 9, 9]. The four single elements are staircases. So is [6, 9, 9]: 6 once, then 9 twice. [6, 6, 9, 9] is not, because 6 comes first and appears twice. Answer 5.

## Key facts

1. A staircase with k distinct values has length T(k) = k(k + 1) / 2. For a left end l, the only candidate right ends are l + T(k) − 1, about √(2n) of them (k ≤ 316 for n = 5 × 10^4).
2. From l, the values in first-appearance order sit at the positions q ≥ l whose previous copy is before l. Call them q1 = l < q2 < q3 < …
3. Give every value a random 64-bit code h. Window [l, r] with exactly k distinct values is a staircase when the sum of h over its elements equals G(k) = 1 · h(v1) + 2 · h(v2) + … + k · h(vk), where vm is the value at qm.

## Steps

1. Precompute prefix sums P of h(nums[i]) and next[i], the next index with the same value.
2. Move l from n − 1 down to 0. The first-occurrence list for l is the list for l + 1 with next[l] removed (that copy is no longer first) and l added at the front. A doubly linked list does both in O(1).
3. Walk the list from the front. At the k-th node add k · h(value) to G, and set r = l + T(k) − 1. Stop once r ≥ n.
4. Count the window when the k-th node is at or before r, the next node is after r (exactly k distinct), and P[r + 1] − P[l] = G.

## Trap

Checking only that the counts form 1 … k in some order. Example 1 then gives 10 instead of 9. Fix: weight each value by its first-appearance rank, which is what G does.

Checked: the examples give 9, 5 and 8, and the method matched part I's direct scan on 400 random arrays.

Time: O(n√n)  
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
