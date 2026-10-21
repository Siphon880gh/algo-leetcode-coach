Given two integer arrays `nums1` and `nums2`, where `nums2` is a rearrangement of `nums1` (duplicates possible), return an array `mapping` where `nums1[i]` equals `nums2[mapping[i]]`. Any valid mapping is accepted. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One pass to index, one pass to map

1. `where[v]` = the list of indexes `j` with `nums2[j] == v`.
2. For each `x` in `nums1`, append `where[x].pop()` to the answer.

Popping gives each duplicate its own index. Because any valid mapping is accepted, using a single stored index per value also passes, but popping is the version that is correct in the strict sense.

Do not search `nums2` for each element; that is O(n²). Do not sort and match by position without carrying the original indexes along.

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
