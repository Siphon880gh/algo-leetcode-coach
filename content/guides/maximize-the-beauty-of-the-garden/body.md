Given an array of flower beauty values (possibly negative), remove any flowers so that at least two remain and the first and last remaining flowers have the same beauty. Return the maximum possible sum of the remaining values. For instance, [1,2,3,1,2] → 8 (keep 2,3,1,2), [100,1,1,-3,1] → 3, and [-1,-2,0,-1] → −2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fix the ends

1. `P[t]` = sum of `max(nums[s], 0)` for `s < t`.
2. Scan `j`; if `nums[j]` was seen first at `i`, candidate `2 · nums[j] + P[j] − P[i + 1]`.
3. Otherwise record `first[nums[j]] = j`.

Constructed checks (verified by brute force over all subsets): `[1,2,3,1,2]` → 8, `[100,1,1,-3,1]` → 3, `[-1,-2,0,-1]` → −2.

The earliest left end is always best: moving it left only adds non-negative middle terms. Ends are added at full value even when negative; the middle drops negatives.

Time: O(n)  
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
