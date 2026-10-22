## Prime reach

1. Factor each `nums[i]`; set `last[p] = i` for each prime p.
2. `reach = 0`. For `i = 0 … n − 2`: `reach = max(reach, last[p])` for each prime p of `nums[i]`; if `reach = i`, return i.
3. Return −1.

Examples → 2, −1. Checked against computing the gcd of both products on 500 random arrays.

The products are far too large to multiply out. Trial division up to √(10^6) = 1000 per value is fast enough, and a value of 1 has no primes.

Time: O(n · √max)  
Space: O(number of distinct primes)

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
