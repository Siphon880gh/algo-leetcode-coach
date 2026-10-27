## Example first

nums = [4, 1, 2], k = 3. Prefix remainders p = [0, 1, 2, 1].

1. The whole array is prefix 0 to prefix 3: p[0] = 0 and p[3] = 1 differ, so no plain match.
2. Negating x inside means p[r] ≡ p[l] + 2x. With x = 2: 0 + 4 ≡ 1 = p[3]. Match, length 3.

## Idea

k ≤ 3000, so there are few remainders. For each left remainder q only its first index first[q] matters, because an earlier left end gives a longer subarray. A negated element at index t needs the left end at or before t. So the moment the scan reaches element t with remainder a = nums[t] mod k, every remainder q with first[q] ≤ t can be shifted by 2a.

## Steps

1. Build p[0 … n] and first[q], the smallest index with p = q.
2. List the remainders that appear, sorted by first index.
3. best[q] = first[q] covers "no negation".
4. Scan element i with a = nums[i] mod k. Advance a pointer pos[a] through the sorted remainders with first[q] ≤ i, and set best[(q + 2a) mod k] = min(best[(q + 2a) mod k], first[q]).
5. Update ans with (i + 1) − best[p[i + 1]].

Each pair (a, q) is unlocked at most once.

## Trap

Letting the negated element sit outside the subarray. In [2, 3] with k = 4, the subarray [2] minus 2 · 3 gives −4, so that rule returns 1 instead of 0. Fix: unlock a remainder only after an element inside the window shows up.

Checked: the examples give 3, 2 and 2, and the scan matched trying every subarray and every negation on 500 random arrays.

Time: O(n + k²)  
Space: O(k)

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
