## Count length-2 chains, collect at length 3

Let `f[i]` be a hash map from difference `d` to the number of subsequences of length at least 2 that end at index `i` with difference `d`. For each pair `j < i`, let `d = nums[i] − nums[j]`:

- Every chain counted in `f[j][d]` extends with `nums[i]` into a chain of length at least 3. Add `f[j][d]` to the answer.
- `f[i][d] += f[j][d] + 1` — the extended chains plus the new pair `(j, i)`.

Pairs are stored but never counted on their own, so only length ≥ 3 reaches the answer. Compute `d` in 64 bits: the difference of two 32-bit values can overflow.

Arithmetic Slices (413) counts contiguous runs only. Longest Arithmetic Subsequence (1027) wants the longest length, not a count.

Do not count pairs in the answer. Do not key by index of the previous element only — the difference matters. Do not use a dense `d` array; differences span about 2^32 values.

Time: O(n²)  
Space: O(n²) map entries

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
