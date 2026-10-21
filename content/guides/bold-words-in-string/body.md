Given a list of keywords and a string `s`, wrap every occurrence of every keyword in `s` with `<b>` and `</b>` tags, using as few tags as possible: overlapping or touching bold parts merge into one tagged run. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Mark first, tag second

1. `bold = [false] * n`. For each start `i` and each keyword `w`, if `s.startswith(w, i)`, mark `bold[i … i + |w| − 1]`. (Tracking the farthest end reached from each start avoids re-marking.)
2. Build the output: open `<b>` when `bold[i]` is true and `i == 0` or `bold[i − 1]` is false; close `</b>` after `i` when `bold[i]` is true and `i == n − 1` or `bold[i + 1]` is false.

Because touching runs are contiguous in `bold`, they merge into one tag pair automatically, which is what "fewest tags" asks for.

A trie of keywords, or Aho-Corasick, speeds up matching for many keywords. This problem is the same as problem 616 (Add Bold Tag in String).

Do not insert tags as you find matches; overlapping matches would produce nested or broken tags. Do not leave touching bold runs as separate tag pairs.

Time: O(n · Σ|w|)  
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
