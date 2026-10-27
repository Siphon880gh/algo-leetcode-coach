## Example first

n = 15, s = 18. Subsets of primes that hit 18: [5, 13], [7, 11], [2, 3, 13], [2, 5, 11].

1. 18 = s, so the sum cannot be beaten.
2. The fewest primes is 2: [5, 13] and [7, 11].
3. [5, 13] is lexicographically smaller because 5 < 7.

## Idea

s ≤ 1000 and there are at most 168 primes, so a subset-sum table fits. To rebuild the lexicographically smallest list, store counts by suffix: suf[i][t] = fewest primes from ps[i …] that sum to exactly t.

## Steps

1. Sieve the primes up to n.
2. suf[m][0] = 0 and infinity elsewhere. For i from m − 1 down to 0: suf[i][t] = min(suf[i + 1][t], suf[i + 1][t − p_i] + 1).
3. T = the largest t ≤ s with suf[0][t] finite. If T = 0, return [].
4. Rebuild with c = suf[0][T] and t = T: take the smallest index k from the current position with suf[k + 1][t − p_k] = c − 1. Append p_k, subtract it, and continue after k.

Taking the smallest workable prime first is what makes the list lexicographically smallest among the fewest.

## Trap

Grabbing the largest prime first. n = 12, s = 8 gives [7] (sum 7) instead of [3, 5] (sum 8). Fix: find the best reachable sum with the DP.

Checked: the examples match, and the result matched ranking every subset on 300 random cases.

Time: O(m · s) with m ≤ 168  
Space: O(m · s)

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
