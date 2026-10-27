## Split in half, count, look up

Four nested loops are `200^4 = 1.6e9` steps — too slow. Split the tuple into two pairs. Build a hash map `cnt` from every sum `a + b` (`a` from `nums1`, `b` from `nums2`) to how many index pairs make it — `n²` entries at most. Then for every `c + d` from `nums3` and `nums4`, add `cnt[−(c + d)]` to the answer. Every matching combination is counted once.

The tuples are index tuples, so repeated values count separately — that is why the map stores counts, not just presence. Sums stay within 2^30, so 32-bit ints are safe.

4Sum (18) picks four distinct indices from one array and must return unique value quadruplets, so it uses sorting and two pointers. Two Sum (1) is the same "store one side, look up the complement" idea.

Do not use a set instead of counts. Do not sort and two-pointer here — you need counts across four arrays, not unique value sets.

Time: O(n²)  
Space: O(n²)

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
