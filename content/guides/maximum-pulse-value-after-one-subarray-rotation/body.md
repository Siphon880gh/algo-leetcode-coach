## Example first

nums = [1, 5, 2]. Pulse = 1 − 5 + 2 = −2. Rotate nums[0..1] to get [5, 1, 2] with pulse 5 − 1 + 2 = 6. Answer 6.

## What a rotation changes

Left-rotating [l..r] moves a[l] to position r, and a[l + 1 … r] each move one place left, so each of those flips sign.

Let s[p] = +1 at even p and −1 at odd p, b[p] = s[p] · a[p], and B[x] = b[0] + … + b[x].

gain(l, r) = s[r] · a[l] − b[l] − 2 · (B[r] − B[l])

Check on the example with l = 0, r = 1: −1 − 1 − 2 · (−4 − 1) = 8, and −2 + 8 = 6.

## Steps

1. base = pulse(nums).
2. Scan r from left to right. Keep two running maxima over l < r: of (a[l] − b[l] + 2B[l]) for even r, and of (−a[l] − b[l] + 2B[l]) for odd r.
3. For each r ≥ 1, candidate = (matching maximum) − 2B[r].
4. Answer = base + max(0, best candidate).

## Trap

Forcing a rotation. In Example 3, [9, 7] becomes [7, 9] with pulse −2, but the operation is at most once. Forcing it gives −2 instead of 2. Fix: keep the gain at least 0.

Checked: the examples give 6, 7 and 2, and the scan matched trying every rotation on 300 random arrays.

Time: O(n)  
Space: O(1)

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
