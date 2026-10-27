You get an array nums of positive integers and an integer k. Split nums into exactly k non-empty contiguous parts. A part whose elements add up to s is worth s · (s + 1) / 2, and the score is the total over all parts. Return the minimum score. This version allows a much longer array than Minimum Partition Score. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Penalty search

1. P = prefix sums.
2. run(λ): f[i] = min over t of f[t] + (P_i − P_t)² + λ, with lines (−2P_t, f[t] + P_t²) in a monotone hull. On ties keep fewer parts. Return (f[n], parts).
3. Binary search the smallest λ in [0, P_n²] with parts ≤ k.
4. g = f[n] − λ · k; return (g + P_n) / 2.

Assumed here: values are positive, so prefix sums increase and the hull stays monotone.

Constructed checks (made-up values, run in code): [3, 1, 4, 1, 5], k = 2 → 57; [2, 7, 1, 8, 2, 8], k = 3 → 145. Checked against the O(k · n²) DP on 3,000 random arrays.

Merging the cheapest neighbors until k parts remain: constructed check [4, 8, 6, 8, 8, 5], k = 2 → 442 instead of 402.

Time: O(n log S), S = total sum  
Space: O(n)

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
