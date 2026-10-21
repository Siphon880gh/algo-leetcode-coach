## Equal remainders mean a multiple of k between them

If prefix sums `P[i]` and `P[j]` (`i < j`) have the same remainder mod `k`, then `nums[i+1..j]` sums to a multiple of `k`.

Keep `first = {0: -1}` (the empty prefix before index 0). Walk `i` with `s = (s + nums[i]) % k`. If `s` is in `first` and `i − first[s] >= 2`, return true. If `s` is not in `first`, store `first[s] = i`. Return false at the end.

Keep only the **first** index of each remainder — it gives the longest subarray, and overwriting could hide a valid length-2 match (`[0,0]` needs the seed −1).

Subarray Sums Divisible by K (974) counts such subarrays instead.

Do not drop the `{0: -1}` seed — then a valid prefix from index 0 is missed. Do not accept length 1 (a single 0 or a single multiple of `k`).

Time: O(n)  
Space: O(min(n, k))

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
